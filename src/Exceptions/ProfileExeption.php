<?php

namespace Appsketch\Profile\Exceptions;


/**
 * Class ProfileExeption
 *
 * @package Appsketch\Profile\Exceptions
 */
class ProfileExeption extends \Exception
{

    /**
     * @param string $required_option
     */
    public function __construct($required_option)
    {
        // Set the message.
        $message = 'The option \'' . $required_option .'\' is required please set it.';

        // Construct the parent.
        parent::__construct($message);
    }
}