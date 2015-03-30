<?php namespace kanazaca\LaravelSteamAuth;

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
        $this->app['steamauth'] = $this->app->share(function () {
            $redirect = Config::get('steam-auth.redirect_url') ?: Config::get('app.url');
            $openId = new LightOpenID(url($redirect));
            return new SteamAuth($openId);
        });
    }

}