<?php namespace mokujinsan\LaravelSteamAuth;

use Config;

class SteamAuth implements SteamAuthInterface
{
    private $openID;
    private $steamID;
    private $steamInfo;

    const OPENID_URL = 'https://steamcommunity.com/openid';
    const STEAM_INFO_URL = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';

    public function __construct(LightOpenID $openID)
    {
        $this->openID = $openID;
        $this->openID->identity = static::OPENID_URL;
        $this->init();
    }

    private function init()
    {
        if($this->openID->mode == 'cancel')
        {
            $this->steamID = false;
        }
        else if($this->openID->mode)
        {
            if($this->openID->validate())
            {
                $this->steamID = basename($this->openID->identity);
            }
            else
            {
                $this->steamID = false;
            }
        }
    }

    /**
     * Gets the steaminfo of that id
     * @return bool|SteamInfo
     */
    public function getSteamInfo() {
        if(!$this->validate()) return false;

        $json = file_get_contents(sprintf(static::STEAM_INFO_URL, Config::get('steam-auth.steam_api_key'), $this->steamID));
        $json = json_decode($json, TRUE);
        return new SteamInfo($json["response"]["players"][0]);
    }

    /**
     * Checks the steam login
     *
     * @return bool
     */
    public function validate()
    {
        return $this->steamID ? true : false;
    }

    /**
     * Returns the redirect response to login
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect()
    {
        return redirect($this->url());
    }

    /**
     * Returns the login url
     *
     * @return String
     */
    public function url()
    {
        return $this->openID->authUrl();
    }

    /**
     * Returns the steam id
     *
     * @return bool|string
     */
    public function getSteamId(){
        return $this->SteamID;
    }

}
