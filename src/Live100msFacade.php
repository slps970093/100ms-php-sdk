<?php

namespace Slps970093\Live100ms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Slps970093\Live100ms\Skeleton\SkeletonClass
 */
class Live100msFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'live100ms';
    }
}
