<?php namespace mokujin\LaravelSteamAuth;

use Config;
use Illuminate\Support\ServiceProvider;

class SteamServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/config.php' => config_path('steam-auth.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mokujin\LaravelSteamAuth\LightOpenID', function($app)
        {
            $redirect = Config::get('steam-auth.redirect_url') ?: Config::get('app.url');
            return new LightOpenID(url($redirect));
        });

        $this->app['steamauth'] = $this->app->share(function ($app) {
            return new SteamAuth($app->make('mokujin\LaravelSteamAuth\LightOpenID'));
        });
    }

}
