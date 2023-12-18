<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\Admin\ApiAuthInterface;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    private $authInterface;

    public function __construct(ApiAuthInterface $interface) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authInterface = $interface;
    }

    public function login(Request $request)
    {
        return $this->authInterface->login($request);
    }

    public function register(Request $request)
    {
        return $this->authInterface->register($request);
    }

    public function logout()
    {
        return $this->authInterface->logout();
    }

    public function refresh()
    {
        return $this->authInterface->refresh();
    }

    public function userProfile()
    {
        return $this->authInterface->userProfile();
    }

}
