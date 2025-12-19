<?php

namespace Kyrch\Prohibition\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kyrch\Prohibition\Prohibition
 */
class Prohibition extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kyrch\Prohibition\Prohibition::class;
    }
}
