<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Traits;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use InvalidArgumentException;
use Kyrch\Prohibition\Events\ModelProhibitionTriggered;
use Kyrch\Prohibition\Models\Prohibition;
use Kyrch\Prohibition\Models\Sanction;

/**
 * @property Collection<int, Prohibition> $prohibitions
 */
trait HasProhibitions
{
    public function prohibitions(): MorphToMany
    {
        return $this->morphToMany(
            config('prohibition.models.prohibition'),
            'model',
            config('prohibition.table_names.model_prohibitions'),
            'model_id',
        );
    }

    public function prohibit(
        Prohibition|string $prohibition,
        ?DateTimeInterface $expiresAt = null,
        ?string $reason = null,
        ?Model $moderator = null,
    ): void {
        if (is_string($prohibition)) {
            $prohibition = config('prohibition.models.prohibition')::query()->firstWhere('name', $prohibition);
        }

        throw_if($prohibition === null, InvalidArgumentException::class, "Prohibition with name '{$prohibition}' does not exist.");

        $this->prohibitions()->attach($prohibition, [
            'moderator_type' => $moderator instanceof Model ? Relation::getMorphAlias($moderator::class) : null,
            'moderator_id' => $moderator instanceof Model ? $moderator->getKey() : null,
            'expires_at' => $expiresAt,
            'reason' => $reason,
        ]);

        if (config('prohibition.events_enabled')) {
            event(new ModelProhibitionTriggered($this->getModel(), $prohibition));
        }
    }

    public function isProhibitedFrom(string $ability): bool
    {
        if ($this->isDirectlyProhibitedFrom($ability)) {
            return true;
        }

        return (bool) $this->isProhibitedViaSanction($ability);
    }

    public function isDirectlyProhibitedFrom(string $ability): bool
    {
        $prohibition = $this->loadMissing('prohibitions')->prohibitions
            ->where('name', $ability)
            ->first();

        if ($prohibition) {
            return $this->checkExpiration($prohibition);
        }

        return false;
    }

    public function isProhibitedViaSanction(string $ability): bool
    {
        return $this->hasSanctionNotExpired(
            config('prohibition.models.prohibition')::query()->firstWhere('name', $ability)?->sanctions
        );
    }

    protected function checkExpiration(Prohibition|Sanction|null $prohibition): bool
    {
        if ($prohibition === null) {
            return false;
        }

        return $prohibition->pivot->expires_at === null || $prohibition->pivot->expires_at->isFuture();
    }
}
