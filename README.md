# Social Profile Links

[![Latest Stable Version](https://poser.pugx.org/appsketch/social-profile/v/stable)](https://packagist.org/packages/appsketch/social-profile) [![Total Downloads](https://poser.pugx.org/appsketch/social-profile/downloads)](https://packagist.org/packages/appsketch/social-profile) [![Latest Unstable Version](https://poser.pugx.org/appsketch/social-profile/v/unstable)](https://packagist.org/packages/appsketch/social-profile) [![License](https://poser.pugx.org/appsketch/social-profile/license)](https://packagist.org/packages/appsketch/social-profile)

## Installation

First, pull in the package through Composer.

```js
composer require appsketch/social-profile
```

And then, if using Laravel 5.1, include the service provider within `app/config/app.php`.

```php
'providers' => [
    Appsketch\Profile\Providers\ServiceProvider::class,
]
```

Aliases will be automatically set in the service provider.

If using Laravel 5. Include this service provider.

```php
'providers' => [
   "Appsketch\Profile\Providers\ServiceProvider"
]
```

Publish the config file to the config folder with the following command.
`php artisan vendor:publish`

Fill out the config file.

## Usage

Within, for example the routes.php add this.

```php
Route::get('/profile', function()
{
    // Facebook profile link.
    $facebook = Profile::facebook();
    
    // Twitter profile link.
    $twitter = Profile::twitter();
    
    // Twitter and facebook.
    $services = Profile::services('twitter', 'facebook');
    
    // Other user's his twitter.
    $twitter_m44rt3np44uw = Profile::twitter('m44rt3np44uw');
    
    // Other user's his services.
    $services_m44rtn3p44uw = Profile::username('m44rt3np44uw')->services('twitter', 'facebook');
});
```

## Available social media's

Got a suggestion? Create an issue. 

| Social media | Method        |
| ------------ |---------------|
| Facebook     | facebook()    |
| Twitter      | twitter()     |
| Google Plus  | google_plus() |
| Linked In    | linked_in()   |
| Instagram    | instagram()   |
| Telegram     | telegram()    |
| Pinterest    | pinterest()   |
| Tumblr       | tumblr()      |
| VK           | vk()          |
| Flickr       | flickr()      |
| Vine         | vine()        |
| Disqus       | disqus()      |
