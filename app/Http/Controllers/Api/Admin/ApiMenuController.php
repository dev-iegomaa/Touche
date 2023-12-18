<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\Admin\ApiMenuInterface;
use Illuminate\Http\Request;

class ApiMenuController extends Controller
{
    private $menuInterface;
    public function __construct(ApiMenuInterface $interface)
    {
        $this->menuInterface = $interface;
    }

    public function index()
    {
        return $this->menuInterface->index();
    }

    public function create(Request $request)
    {
        return $this->menuInterface->create($request);
    }

    public function delete(Request $request)
    {
        return $this->menuInterface->delete($request);
    }

    public function update(Request $request)
    {
        return $this->menuInterface->update($request);
    }
}
