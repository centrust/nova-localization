<?php

namespace Centrust\NovaLocalization\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Centrust\NovaLocalization\NovaLocalization
 */
class NovaLocalization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Centrust\NovaLocalization\NovaLocalization::class;
    }
}
