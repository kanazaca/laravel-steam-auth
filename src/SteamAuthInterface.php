<?php
namespace mokujin\LaravelSteamAuth;

interface SteamAuthInterface
{
    public function url();

    public function redirect();

    public function validate();
}
