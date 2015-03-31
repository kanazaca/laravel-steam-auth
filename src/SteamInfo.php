<?php

namespace kanazaca\LaravelSteamAuth;

use Config;

/**
 * Class SteamInfo
 * @package kanazaca\LaravelSteamAuth
 */
class SteamInfo
{
    protected $steamID;
    protected $nick;
    protected $lastLogin;
    protected $profileURL;
    protected $profilePicture;
    protected $profilePictureMedium;
    protected $profilePictureFull;
    protected $name;
    protected $clanID;
    protected $createdAt;
    protected $countryCode;

    function __construct($data)
    {
        $this->steamID              = $data["steamid"];
        $this->nick                 = $data["personaname"];
        $this->lastLogin            = $data["lastlogoff"];
        $this->profileURL           = $data["profileurl"];
        $this->profilePicture       = $data["avatar"];
        $this->profilePictureMedium = $data["avatarmedium"];
        $this->profilePictureFull   = $data["avatarfull"];
        $this->name                 = $data["realname"];
        $this->clanID               = $data["primaryclanid"];
        $this->createdAt            = $data["timecreated"];
        $this->countryCode          = $data["loccountrycode"];
    }

    /**
     * @return mixed
     */
    public function getSteamID()
    {
        return $this->steamID;
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @return mixed
     */
    public function getProfileURL()
    {
        return $this->profileURL;
    }

    /**
     * @return mixed
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * @return mixed
     */
    public function getProfilePictureMedium()
    {
        return $this->profilePictureMedium;
    }

    /**
     * @return mixed
     */
    public function getProfilePictureFull()
    {
        return $this->profilePictureFull;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getClanID()
    {
        return $this->clanID;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}
