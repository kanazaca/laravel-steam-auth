# Steam authentication for laravel 5
This package is a Laravel 5 service provider which provides Steam OpenID and is very easy to integrate with any project which requires steam authentication.

## Installation Via Composer
Add this to your composer.json file, in the require object:

```javascript
"kanazaca/laravel-steam-auth": "1.1.*"
```

After that, run composer install to install the package.

Add the service provider to `app/config/app.php`, within the `providers` array.

```php
'providers' => array(
	// ...
	'kanazaca\LaravelSteamAuth\SteamServiceProvider',
)
```

```php
'aliases' => array(
	// ...
        'SteamAuth' => 'kanazaca\LaravelSteamAuth\Facades\SteamAuth',
)
```
You how have access to the `SteamAuth` facade.

Lastly, publish the config file.
```
php artisan vendor:publish
```
## Usage
```php
use kanazaca\LaravelSteamAuth\SteamAuth;

class SteamController extends Controller {

    /**
     * @var SteamAuth
     */
    private $steam;

    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

	public function getLogin()
	{

        if( $this->steam->validate()){
            return  $this->steam->steamInfo;  //returns the user steam info
        }else{
            return  $this->steam->redirect(); //redirect to steam login page
        }
	}
}
```
# Credits
* invisnik (original maintainer)
