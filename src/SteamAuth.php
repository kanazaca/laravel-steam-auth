<?php namespace kanazaca\LaravelSteamAuth;

use Config;

class SteamAuth implements SteamAuthInterface
{

    private $OpenID;
    public $redirect_url;
    public $steamInfo;

    const OPENID_URL = 'https://steamcommunity.com/openid';

    public function __construct()
    {
        $this->redirect_url = Config::get('steam-auth.redirect_url');
        $this->OpenID = new LightOpenID($this->redirect_url);
        $this->OpenID->identity = self::OPENID_URL;
        $this->init();
    }

    private function init()
    {
        if ($this->OpenID->mode == 'cancel') {

            $this->steamInfo = FALSE;

        } else if ($this->OpenID->mode) {

            if ($this->OpenID->validate()) {

                $this->steamInfo = new SteamInfo($this->OpenID->identity);

            }

        }
    }

    public function validate()
    {
        return $this->steamInfo ? TRUE : FALSE;
    }

    public function redirect()
    {
        return redirect($this->url());
    }

    public function url()
    {
        return $this->OpenID->authUrl();
    }

}