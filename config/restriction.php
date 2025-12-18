<?php

declare(strict_types=1);

use Kyrch\LaravelRestrictions\Models\Restriction;
use Kyrch\LaravelRestrictions\Models\Sanction;
use Kyrch\LaravelRestrictions\Pivots\ModelRestriction;
use Kyrch\LaravelRestrictions\Pivots\ModelSanction;

return [
    'models' => [
        'restriction' => Restriction::class,
        'sanction' => Sanction::class,
        'model_restriction' => ModelRestriction::class,
        'model_sanction' => ModelSanction::class,
    ],

    'table_names' => [
        'restriction' => 'restrictions',
        'sanction' => 'sanctions',
        'sanction_restriction' => 'sanction_restriction',
        'model_sanctions' => 'model_sanctions',
        'model_restrictions' => 'model_restrictions',
    ],
];
