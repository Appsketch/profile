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
        'twitter'     => Profile::TWITTER,
        'facebook'    => Profile::FACEBOOK,
        'google_plus' => Profile::GOOGLE_PLUS,
        'linked_in'   => Profile::LINKED_IN,
        'instagram'   => Profile::INSTAGRAM,
        'telegram'    => Profile::TELEGRAM,
        'pinterest'   => Profile::PINTEREST,
        'tumblr'      => Profile::TUMBLR,
        'vk'          => Profile::VK,
        'flickr'      => Profile::FLICKR,
        'vine'        => Profile::VINE
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
     * GOOGLE PLUS
     */
    const GOOGLE_PLUS = 'https://plus.google.com/u/0/+{{username}}';

    /**
     * LINKED IN
     */
    const LINKED_IN = 'https://nl.linkedin.com/in/{{username}}';

    /**
     * INSTAGRAM
     */
    const INSTAGRAM = 'https://instagram.com/{{username}}';

    /**
     * TELEGRAM
     */
    const TELEGRAM = 'https://web.telegram.org/#/im?p=@{{username}}';

    /**
     * PINTEREST
     */
    const PINTEREST = 'https://www.pinterest.com/{{username}}';

    /**
     * TUMBLR
     */
    const TUMBLR = 'http://{{username}}.tumblr.com';

    /**
     * VK
     */
    const VK = 'http://vk.com/{{username}}';

    /**
     * FLICKR
     */
    const FLICKR = 'https://www.flickr.com/photos/{{username}}';

    /**
     * VINE
     */
    const VINE = 'https://vine.co/{{username}}';

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
     * @param null $social_media
     *
     * @return array|null
     */
    private function getSocialMedia($social_media = null)
    {
        // Check if specific social media isset.
        if(isset($social_media) && !empty($social_media))
        {
            // Social media.
            $social_medias = $this->getSocialMedia();

            // Check if the social media url exists.
            if(array_key_exists($social_media, $social_medias))
            {
                // Return the social media url.
                return $social_medias[$social_media];
            }

            // If not.
            else
            {
                // Return null.
                return null;
            }
        }

        // If not.
        else
        {
            // Return the whole array.
            return $this->social_media;
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
     * Get the social media profile link.
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        // Method
        $method = strtolower($method);

        // Check if the called social network exists.
        if(array_key_exists($method, $this->social_media))
        {
            if(isset($args) && !empty($args))
            {
                // Overwrite the default username.
                $this->updateUsername($args[0]);
            }

            // Return the parsed twitter url.
            return $this->parseUrl($method);
        }
    }

    /**
     * Overwrite the default username.
     *
     * @param $username
     *
     * @return $this
     */
    public function username($username)
    {
        // Overwrite the default username.
        $this->updateUsername($username);

        // Return this.
        return $this;
    }

    /**
     * Overwrite the default username.
     *
     * @param $username
     *
     * @return Profile
     */
    public function user($username)
    {
        return $this->username($username);
    }

    /**
     * @return array
     */
    public function services()
    {
        // The requested services.
        $requested_services = func_get_args();

        // Services
        $services = [];

        // Loop through each requested services.
        foreach ($requested_services as $requested_service)
        {
            // Check if the requested media exists.
            if(array_key_exists($requested_service, $this->social_media))
            {
                // Push the result from the service to the services array.
                $services[$requested_service] = $this->$requested_service();
            }
        }

        // return the services array.
        return $services;
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