<?php

declare(strict_types=1);

use Kyrch\Restriction\Models\Restriction;
use Kyrch\Restriction\Models\Sanction;
use Kyrch\Restriction\Pivots\ModelRestriction;
use Kyrch\Restriction\Pivots\ModelSanction;

return [
    'events_enabled' => true,

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
