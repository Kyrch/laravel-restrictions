<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

/**
 * @property Carbon|null $expires_at
 * @property string $model_type
 * @property int|string $model_id
 * @property string|null $moderator_type
 * @property int|string|null $moderator_id
 * @property int $restriction_id
 * @property string|null $reason
 * @property string $target_type
 * @property int|string $target_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ModelRestriction extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = Config::get('restriction.table_names.model_restrictions');

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }
}
