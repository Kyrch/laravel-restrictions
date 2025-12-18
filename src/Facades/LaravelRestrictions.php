<?php

namespace Kyrch\LaravelRestrictions\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kyrch\LaravelRestrictions\LaravelRestrictions
 */
class LaravelRestrictions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kyrch\LaravelRestrictions\LaravelRestrictions::class;
    }
}
