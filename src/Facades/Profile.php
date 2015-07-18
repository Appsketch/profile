<?php

namespace Appsketch\Profile\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Yo
 *
 * @package Appsketch\Justyo\Facades
 */
class Profile extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Appsketch\Profile\Profile';
    }

}