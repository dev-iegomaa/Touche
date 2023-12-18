<?php

namespace App\Http\Interfaces\Api\Admin;

interface ApiAuthInterface
{
    public function login($request);
    public function register($request);
    public function logout();
    public function refresh();
    public function userProfile();
}
