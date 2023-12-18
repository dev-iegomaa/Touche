<?php

namespace App\Http\Controllers\Api\EndUser;

use App\Http\Interfaces\Api\EndUser\ApiUserInterface;
use Illuminate\Http\Request;

class ApiUserController
{
    private $userInterface;
    public function __construct(ApiUserInterface $interface)
    {
        $this->userInterface = $interface;
    }

    public function index()
    {
        return $this->userInterface->index();
    }

    public function menu()
    {
        return $this->userInterface->menu();
    }

    public function gallery()
    {
        return $this->userInterface->gallery();
    }

    public function chef()
    {
        return $this->userInterface->chef();
    }

    public function contact(Request $request)
    {
        return $this->userInterface->contact($request);
    }
}
