<?php

declare(strict_types=1);

namespace Kyrch\Restriction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Kyrch\Restriction\Contracts\Restriction as RestrictionContract;

/**
 * @property int $id
 * @property string $name
 */
class Restriction extends Model implements RestrictionContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = Config::get('restriction.table_names.restriction');
}
