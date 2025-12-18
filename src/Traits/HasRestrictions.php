<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Traits;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use InvalidArgumentException;
use Kyrch\Restriction\Events\ModelRestricted;
use Kyrch\Restriction\Models\Restriction;
use Kyrch\Restriction\Models\Sanction;

/**
 * @property Collection<int, Restriction> $restrictions
 */
trait HasRestrictions
{
    public function restrictions(): MorphToMany
    {
        return $this->morphToMany(
            config('restriction.models.restriction'),
            'model',
            config('restriction.table_names.model_restrictions'),
            'model_id',
        );
    }

    public function restrict(
        Restriction|string $restriction,
        ?DateTimeInterface $expiresAt = null,
        ?string $reason = null,
        ?Model $target = null,
        ?Model $moderator = null,
    ): void {
        if (is_string($restriction)) {
            $restriction = Restriction::query()->firstWhere('name', $restriction);
        }

        throw_if($restriction === null, InvalidArgumentException::class, "Restriction with name '{$restriction}' does not exist.");

        $this->restrictions()->attach($restriction, [
            'target_type' => $target instanceof Model ? Relation::getMorphAlias($target::class) : null,
            'target_id' => $target instanceof Model ? $target->getKey() : null,
            'moderator_type' => $moderator instanceof Model ? Relation::getMorphAlias($moderator::class) : null,
            'moderator_id' => $moderator instanceof Model ? $moderator->getKey() : null,
            'expires_at' => $expiresAt,
            'reason' => $reason,
        ]);

        if (config('restriction.events_enabled')) {
            event(new ModelRestricted($this->getModel(), $restriction));
        }
    }

    public function isRestricted(string $ability, ?Model $target = null): bool
    {
        if ($this->isDirectlyRestricted($ability, $target)) {
            return true;
        }

        return (bool) $this->isRestrictedViaSanction($ability);
    }

    public function isDirectlyRestricted(string $ability, ?Model $target = null): bool
    {
        $restriction = $this->loadMissing('restrictions')->restrictions
            ->where('name', $ability)
            ->when($target instanceof Model, fn (Collection $collection) => $collection->where('target_type', Relation::getMorphAlias($target::class))->where('target_id', $target->getKey()))
            ->first();

        if ($restriction) {
            return $this->checkExpiration($restriction);
        }

        return false;
    }

    public function isRestrictedViaSanction(string $ability): bool
    {
        return $this->hasSanction(
            Restriction::query()->firstWhere('name', $ability)->sanctions
        );
    }

    protected function checkExpiration(Restriction|Sanction|null $restriction): bool
    {
        if ($restriction === null) {
            return false;
        }

        return $restriction->pivot->expires_at === null || $restriction->pivot->expires_at->isFuture();
    }
}
