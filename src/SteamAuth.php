<?php namespace Invisnik\LaravelSteamAuth;

use Invisnik\LaravelSteamAuth\LightOpenID;

class SteamAuth implements SteamAuthInterface {

    private $OpenID;

    public $SteamID = false;

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

                $steamid64 = str_replace('http://steamcommunity.com/openid/id/', '', $this->OpenID->identity);

                if ($steamid64)
                {
                    $json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . \Config::get('steam-auth.steam_api_key') . '&steamids=' . $steamid64);
                    $json = json_decode($json, true);
                    $user = $json["response"]["players"][0];

                    $this->setSteamInfo($user);
                }

                $this->SteamID = basename($this->OpenID->identity);

            }else{

                $this->SteamID = false;

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

    public function getSteamId(){
        return $this->SteamID;
    }

    public function setSteamInfo($user)
    {
        $this->steamInfo = $user;
    }

}