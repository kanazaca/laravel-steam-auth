<?php
namespace kanazaca\LaravelSteamAuth;

interface SteamAuthInterface
{
    public function url();
    public function redirect();
    public function validate();
}