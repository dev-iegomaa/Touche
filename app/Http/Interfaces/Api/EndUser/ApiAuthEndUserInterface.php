<?php

namespace App\Http\Interfaces\Api\EndUser;

interface ApiAuthEndUserInterface
{
    public function login($request);
    public function logout();
    public function register($request);
    public function refresh();
    public function userProfile();
}
