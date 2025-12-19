<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;

class Sanction extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(Config::get('prohibition.table_names.sanction'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    public function prohibitions(): BelongsToMany
    {
        return $this->belongsToMany(
            Prohibition::class,
            config('prohibition.table_names.sanction_prohibition'),
        );
    }
}
