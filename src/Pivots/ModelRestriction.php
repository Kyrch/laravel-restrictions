<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

/**
 * @property Carbon|null $expires_at
 * @property string $model_type
 * @property int|string $model_id
 * @property string|null $moderator_type
 * @property int|string|null $moderator_id
 * @property int $prohibition_id
 * @property string|null $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ModelProhibition extends Pivot
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(Config::get('prohibition.table_names.model_prohibitions'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'expires_at',
        'model_type',
        'model_id',
        'moderator_type',
        'moderator_id',
        'prohibition_id',
        'reason',
    ];

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
