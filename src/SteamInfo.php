<?php

namespace kanazaca\LaravelSteamAuth;
use Config;

/**
 * Class SteamInfo
 * @package kanazaca\LaravelSteamAuth
 */
class SteamInfo
{

    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $nick;
    /**
     * @var
     */
    protected $lastLogin;
    /**
     * @var
     */
    protected $profileURL;
    /**
     * @var
     */
    protected $profilePicture;
    /**
     * @var
     */
    protected $profilePictureMedium;
    /**
     * @var
     */
    protected $profilePictureFull;
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $clanID;
    /**
     * @var
     */
    protected $createdAt;

    /**
     * @var
     */
    protected $all;

    /**
     * @var string
     */
    protected $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';

    function __construct($id)
    {
        $this->id = $id;

        $this->getJson(); //Get steamInfo from json and save it to $this->all
        $this->setId($this->all["steamid"]);
        $this->setNick($this->all["personaname"]);
        $this->setLastLogin($this->all["lastlogoff"]);
        $this->setProfileURL($this->all["profileurl"]);
        $this->setProfilePicture($this->all["avatar"]);
        $this->setProfilePictureMedium($this->all["avatarmedium"]);
        $this->setProfilePictureFull($this->all["avatarfull"]);
        $this->setName($this->all["realname"]);
        $this->setClanID($this->all["primaryclanid"]);
        $this->setCreatedAt($this->all["timecreated"]);
    }


    /**
     * @return mixed
     */
    protected function getJson()
    {
        $json = file_get_contents(sprintf($this->url, Config::get('steam-auth.steam_api_key'), $this->id));
        $json = json_decode($json, TRUE);
        $steam = $json["response"]["players"][0];

        $this->all = $steam;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param mixed $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param mixed $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return mixed
     */
    public function getProfileURL()
    {
        return $this->profileURL;
    }

    /**
     * @param mixed $profileURL
     */
    public function setProfileURL($profileURL)
    {
        $this->profileURL = $profileURL;
    }

    /**
     * @return mixed
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * @param mixed $profilePicture
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
    }

    /**
     * @return mixed
     */
    public function getProfilePictureMedium()
    {
        return $this->profilePictureMedium;
    }

    /**
     * @param mixed $profilePictureMedium
     */
    public function setProfilePictureMedium($profilePictureMedium)
    {
        $this->profilePictureMedium = $profilePictureMedium;
    }

    /**
     * @return mixed
     */
    public function getProfilePictureFull()
    {
        return $this->profilePictureFull;
    }

    /**
     * @param mixed $profilePictureFull
     */
    public function setProfilePictureFull($profilePictureFull)
    {
        $this->profilePictureFull = $profilePictureFull;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getClanID()
    {
        return $this->clanID;
    }

    /**
     * @param mixed $clanID
     */
    public function setClanID($clanID)
    {
        $this->clanID = $clanID;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


}
