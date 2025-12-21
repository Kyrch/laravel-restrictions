<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Pivots;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Kyrch\Prohibition\Models\Sanction;

/**
 * @property Carbon|null $expires_at
 * @property string $model_type
 * @property int|string $model_id
 * @property string|null $moderator_type
 * @property int|string|null $moderator_id
 * @property string|null $reason
 * @property int $sanction_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ModelSanction extends MorphPivot
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(Config::string('prohibition.table_names.model_sanctions'));
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
        'sanction_id',
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

    /**
     * @return BelongsTo<Sanction, $this>
     */
    public function sanction(): BelongsTo
    {
        /** @var class-string<Sanction> $sanction */
        $sanction = Config::string('prohibition.models.sanction');

        return $this->belongsTo(
            $sanction,
            'sanction_id',
        );
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function prohibited(): MorphTo
    {
        return $this->morphTo('model');
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function moderator(): MorphTo
    {
        return $this->morphTo('moderator');
    }
}
