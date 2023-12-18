<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\Admin\ApiMealInterface;
use Illuminate\Http\Request;

class ApiMealController extends Controller
{
    private $mealInterface;
    public function __construct(ApiMealInterface $interface)
    {
        $this->mealInterface = $interface;
    }

    public function index()
    {
        return $this->mealInterface->index();
    }

    public function create(Request $request)
    {
        return $this->mealInterface->create($request);
    }

    public function delete(Request $request)
    {
        return $this->mealInterface->delete($request);
    }

    public function update(Request $request)
    {
        return $this->mealInterface->update($request);
    }

}
