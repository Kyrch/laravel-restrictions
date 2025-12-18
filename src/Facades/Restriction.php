<?php

namespace Kyrch\Restriction\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kyrch\Restriction\Restriction
 */
class Restriction extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kyrch\Restriction\Restriction::class;
    }
}
