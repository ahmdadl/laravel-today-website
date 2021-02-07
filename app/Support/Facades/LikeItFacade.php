<?php

namespace App\Support\Facades;

use App\Support\LikeIt;
use Illuminate\Support\Facades\Facade;

class LikeItFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LikeIt::class;
    }
}
