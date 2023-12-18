<?php

namespace App\Http\Repositories\Api\EndUser;

use App\Http\Interfaces\Api\EndUser\ApiUserInterface;
use App\Http\Traits\Api\apiResponse;
use App\Http\Traits\Redis\ChefRedis;
use App\Http\Traits\Redis\MealRedis;
use App\Http\Traits\Redis\MenuRedis;
use App\Models\Chef;
use App\Models\ContactUs;
use App\Models\Meal;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class ApiUserRepository implements ApiUserInterface
{
    use apiResponse, MenuRedis, ChefRedis, MealRedis {
        MealRedis::uploadImage insteadof  ChefRedis;
    }

    private $menuModel;
    private $mealModel;
    private $chefModel;
    private $contactModel;
    public function __construct(Chef $chef, Menu $menu, Meal $meal, ContactUs $contact)
    {
        $this->chefModel = $chef;
        $this->menuModel = $menu;
        $this->mealModel = $meal;
        $this->contactModel = $contact;
    }

    public function index()
    {
        $chefs = $this->getChefFromRedis();
        $menus = $this->getMenuFromRedis();
        $meals = $this->getMealFromRedis();
        return $this->apiResponse(200, 'Chef Data , Menu And Meal', [
            'chefs' => $chefs,
            'menus' => $menus,
            'meals' => $meals
        ]);
    }

    public function menu()
    {
        $menus = $this->getMenuFromRedis();
        return $this->apiResponse(200, 'Menu Data', $menus);
    }

    public function gallery()
    {
        $meals = $this->getMealFromRedis();
        return $this->apiResponse(200, 'Meal Data', $meals);
    }

    public function chef()
    {
        $chefs = $this->getChefFromRedis();
        return $this->apiResponse(200, 'Chef Data', $chefs);
    }

    public function contact($request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|unique:contact_us,email',
            'message'   => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null , $validator->errors());
        }

        $this->contactModel::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'message'   => $request->message
        ]);

        return $this->apiResponse(200, 'Send Your Message Successful :)');
    }
}
