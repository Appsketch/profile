<?php

namespace Appsketch\Profile;

use Appsketch\Profile\Exceptions\ProfileExeption;
use Illuminate\Support\Facades\Config;

/**
 * Class Profile
 *
 * @package Appsketch\Profile
 */
class Profile
{
    /**
     * @var
     */
    private $username;

    /**
     * @var array
     */
    private $social_media = [
        'twitter'  => Profile::TWITTER,
        'facebook' => Profile::FACEBOOK
    ];

    /**
     * TWITTER
     */
    const TWITTER = 'https://twitter.com/{{username}}';

    /**
     * FACEBOOK
     */
    const FACEBOOK = 'https://www.facebook.com/{{username}}';

    /**
     * @return mixed
     */
    private function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    private function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * Get the social media link.
     *
     * @param $social_media
     *
     * @return string|null
     */
    private function getSocialMedia($social_media)
    {
        // Check if the social media url exists.
        if(array_key_exists($social_media, $this->social_media))
        {
            // Return the social media url.
            return $this->social_media[$social_media];
        }

        // If not.
        else
        {
            // Return null.
            return null;
        }
    }

    /**
     * Construct the Profile class.
     */
    public function __construct()
    {
        // Initialize the options.
        $this->initializeOptions();
    }

    /**
     * Get the twitter profile url.
     *
     * @param null $username
     *
     * @return mixed
     */
    public function twitter($username = null)
    {
        // Overwrite the default username.
        $this->updateUsername($username);

        // Return the parsed twitter url.
        return $this->parseUrl('twitter');
    }

    /**
     * Get the facebook profile url.
     *
     * @param null $username
     *
     * @return mixed
     */
    public function facebook($username = null)
    {
        // Overwrite the default username.
        $this->updateUsername($username);

        // Return the parsed facebook url.
        return $this->parseUrl('facebook');
    }

    /**
     * Initialize the default options.
     */
    private function initializeOptions()
    {
        // Get the username.
        $username = Config::get("profile.username");

        // Check if the default username isset and not empty.
        if(isset($username) && !empty($username))
        {
            // Set the default username.
            $this->setUsername($username);
        }
    }

    /**
     * Overwrite the default username.
     *
     * @param null $username
     *
     * @throws ProfileExeption
     */
    private function updateUsername($username = null)
    {
        // Update the username.
        if(isset($username) && !empty($username))
        {
            $this->setUsername($username);
        }

        // Check options.
        $this->checkOptions('username');
    }

    /**
     * Check the required options.
     *
     * @throws ProfileExeption
     */
    private function checkOptions()
    {
        // Required options.
        $required_options = func_get_args();

        // Loop throught all the required options.
        foreach ($required_options as $required_option)
        {
            // Check if the options is not set.
            if(!isset($this->$required_option) || empty($this->$required_option))
            {
                // Throw the exception.
                Throw new ProfileExeption($required_option);
            }
        }

    }

    /**
     * Parse the social urls.
     *
     * @param $social_media
     *
     * @return mixed
     */
    private function parseUrl($social_media)
    {
        // Get the social media url.
        $url = $this->getSocialMedia($social_media);

        // Get the username
        $username = $this->getUsername();

        // Return the social profile url.
        return str_replace('{{username}}', $username, $url);
    }
}