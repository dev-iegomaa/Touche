<?php

namespace App\Http\Controllers\Web\EndUser;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\EndUser\EndUserInterface;
use App\Http\Requests\EndUser\EndUserRequest;

class EndUserController extends Controller
{

    private $endUserInterface;
    public function __construct(EndUserInterface $interface)
    {
        $this->endUserInterface = $interface;
    }

    public function index()
    {
        return $this->endUserInterface->index();
    }

    public function menu()
    {
        return $this->endUserInterface->menu();
    }

    public function gallery()
    {
        return $this->endUserInterface->gallery();
    }

    public function chef()
    {
        return $this->endUserInterface->chef();
    }

    public function contact()
    {
        return $this->endUserInterface->contact();
    }

    public function storeUserMessage(EndUserRequest $request)
    {
        return $this->endUserInterface->storeUserMessage($request);
    }
}
