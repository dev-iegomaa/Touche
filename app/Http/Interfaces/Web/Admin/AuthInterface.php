<?php

namespace App\Http\Interfaces\Web\Admin;

interface AuthInterface
{
    public function index();
    public function login($request);
    public function logout();
}
