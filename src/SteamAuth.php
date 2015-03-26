<?php namespace Invisnik\LaravelSteamAuth;

use Invisnik\LaravelSteamAuth\LightOpenID;
use Invisnik\LaravelSteamAuth\SteamInfo;

class SteamAuth implements SteamAuthInterface {

    private $OpenID;

    public $redirect_url;

    public $steamInfo;

    public function __construct()
    {
        $this->redirect_url = \Config::get('steam-auth.redirect_url') ? \Config::get('steam-auth.redirect_url') :  $_SERVER['SERVER_NAME'];
        $this->OpenID = new LightOpenID($this->redirect_url);
        $this->OpenID->identity = 'https://steamcommunity.com/openid';
        $this->init();
    }

    private function init()
    {
        if($this->OpenID->mode == 'cancel'){

            $this->SteamID = false;

        }else if($this->OpenID->mode){

            if($this->OpenID->validate()){

                $this->steamInfo = new SteamInfo($this->OpenID->identity);

            }

        }
    }

    public function validate()
    {
        return $this->SteamID ? true : false;
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