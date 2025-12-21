<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Pivots;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Kyrch\Prohibition\Models\Prohibition;

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
class ModelProhibition extends MorphPivot
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(Config::string('prohibition.table_names.model_prohibitions'));
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

    /**
     * @return BelongsTo<Prohibition, $this>
     */
    public function prohibition(): BelongsTo
    {
        /** @var class-string<Prohibition> $prohibition */
        $prohibition = Config::string('prohibition.models.prohibition');

        return $this->belongsTo(
            $prohibition,
            'prohibition_id',
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
