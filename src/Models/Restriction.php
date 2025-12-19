<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Config;

class Restriction extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(Config::get('restriction.table_names.restriction'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    public function sanctions(): BelongsToMany
    {
        return $this->belongsToMany(
            Sanction::class,
            config('restriction.table_names.sanction_restriction'),
        );
    }
}
