<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Facade;

arch()
    ->expect('App')
    ->toUseStrictTypes()
    ->not->toUse(['die', 'dd', 'dump', 'var_dump']);

arch()
    ->expect('App\Contracts')
    ->toBeInterfaces();

arch()
    ->expect('App\Facades')
    ->toBeClasses()
    ->toExtend(Facade::class);

arch()
    ->expect('App\Models')
    ->toBeClasses()
    ->toExtend(Model::class);

arch()
    ->expect('App\Pivots')
    ->toBeClasses()
    ->toExtend(Pivot::class);

arch()
    ->expect('App\Traits')
    ->toBeTraits();
