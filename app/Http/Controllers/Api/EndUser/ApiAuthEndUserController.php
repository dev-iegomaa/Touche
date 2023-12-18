<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\EndUser\ApiAuthEndUserInterface;
use Illuminate\Http\Request;

class ApiAuthEndUserController extends Controller
{

    private $authInterface;
    public function __construct(ApiAuthEndUserInterface $interface)
    {
        $this->authInterface = $interface;
    }

    public function login(Request $request)
    {
        return $this->authInterface->login($request);
    }

    public function logout()
    {
        return $this->authInterface->logout();
    }

    public function register(Request $request)
    {
        return $this->authInterface->register($request);
    }

    public function refresh() {
        return $this->authInterface->refresh();
    }

    public function userProfile() {
        return $this->authInterface->userProfile();
    }
}
