<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\Admin\ApiChefInterface;
use Illuminate\Http\Request;

class ApiChefController extends Controller
{

    private $chefInterface;
    public function __construct(ApiChefInterface $interface)
    {
        $this->chefInterface = $interface;
    }

    public function index()
    {
        return $this->chefInterface->index();
    }

    public function create(Request $request)
    {
        return $this->chefInterface->create($request);
    }

    public function delete(Request $request)
    {
        return $this->chefInterface->delete($request);
    }

    public function update(Request $request)
    {
        return $this->chefInterface->update($request);
    }

}
