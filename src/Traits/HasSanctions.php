<?php

declare(strict_types=1);

namespace Kyrch\LaravelRestrictions\Traits;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Kyrch\LaravelRestrictions\Events\ModelSanctioned;
use Kyrch\LaravelRestrictions\Models\Sanction;
use TypeError;

/**
 * @property Collection<int, Sanction> $sanctions
 */
trait HasSanctions
{
    use HasRestrictions;

    public function sanctions(): MorphToMany
    {
        return $this->morphToMany(
            config('restriction.models.sanction'),
            'model',
            config('restriction.table_names.model_sanctions'),
            'model_id',
        );
    }

    public function applySanction(
        Sanction|string $sanction,
        ?DateTimeInterface $expiresAt = null,
        ?string $reason = null,
        ?Model $moderator = null,
    ): void {
        if (is_string($sanction)) {
            $sanction = Sanction::query()->firstWhere('name', $sanction);
        }

        throw_if($sanction === null, InvalidArgumentException::class, "Sanction with name '{$sanction}' does not exist.");

        $this->sanctions()->attach($sanction, [
            'moderator_type' => $moderator instanceof Model ? Relation::getMorphAlias($moderator::class) : null,
            'moderator_id' => $moderator instanceof Model ? $moderator->getKey() : null,
            'expires_at' => $expiresAt,
            'reason' => $reason,
        ]);

        if (config('restriction.events_enabled')) {
            event(new ModelSanctioned($this->getModel(), $sanction));
        }
    }

    /**
     * @param  string|array|Collection  $sanctions
     */
    public function hasSanctionNotExpired($sanctions): bool
    {
        $this->loadMissing('sanctions');

        if (is_string($sanctions)) {
            return $this->checkExpiration($this->sanctions->firstWhere('name', $sanctions));
        }

        if (is_array($sanctions)) {
            return array_any($sanctions, fn ($sanction) => $this->hasSanctionNotExpired($sanction));
        }

        if ($sanctions instanceof Collection) {
            return $sanctions->intersect($this->sanctions)->filter(fn (Sanction $sanction) => $this->checkExpiration($sanction))->isNotEmpty();
        }

        throw new TypeError('Unexpected type for $sanctions parameter');
    }
}
