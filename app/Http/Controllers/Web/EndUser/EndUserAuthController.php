<?php

namespace App\Http\Controllers\Web\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\EndUser\EndUserAuthInterface;
use Illuminate\Http\Request;

class EndUserAuthController extends Controller
{
    private $authInterface;
    public function __construct(EndUserAuthInterface $interface)
    {
        $this->authInterface = $interface;
    }
    public function login_page()
    {
        return $this->authInterface->login_page();
    }
    public function register_page()
    {
        return $this->authInterface->register_page();
    }
    public function registerData(Request $request)
    {
        return $this->authInterface->registerData($request);
    }
    public function loginData(Request $request)
    {
        return $this->authInterface->loginData($request);
    }
}
