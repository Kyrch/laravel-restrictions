<?php

declare(strict_types=1);

namespace Kyrch\LaravelRestrictions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property string $name
 */
class Sanction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = Config::get('restriction.table_names.sanction');
}
