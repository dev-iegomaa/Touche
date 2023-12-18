<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Admin\AuthInterface;
use App\Http\Requests\Admin\Auth\AuthRequest;

class AuthController extends Controller
{

    private $authInterface;

    public function __construct(AuthInterface $interface)
    {
        $this->authInterface = $interface;
    }

    public function index()
    {
        return $this->authInterface->index();
    }

    public function login(AuthRequest $request)
    {
        return $this->authInterface->login($request);
    }

    public function logout()
    {
        return $this->authInterface->logout();
    }

}
