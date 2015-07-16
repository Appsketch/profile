# Social Profile Links

## Installation

First, pull in the package through Composer.

```js
composer require appsketh/social-profile
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
