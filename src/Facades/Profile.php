<?php

namespace Appsketch\Profile\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Yo
 *
 * @package M44rt3np44uw\Justyo\Facades
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