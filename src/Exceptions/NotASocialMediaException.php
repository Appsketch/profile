<?php
    /**
     * Created by PhpStorm.
     * User: maartenpaauw
     * Date: 16-07-15
     * Time: 20:08
     */

    namespace Appsketch\Profile\Exceptions;


    /**
     * Class NotASocialMediaException
     *
     * @package Appsketch\Profile\Exceptions
     */
    class NotASocialMediaException extends \Exception
    {
        /**
         *
         */
        public function __construct()
        {
            // Message
            $message = "Not a supported social media. You may want to suggest this social media via: http://www.github.com/appsketch/profile/issues";

            parent::__construct($message);
        }
    }