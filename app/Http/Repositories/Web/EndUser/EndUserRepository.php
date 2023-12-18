<?php

namespace App\Http\Repositories\Web\EndUser;

use App\Http\Interfaces\Web\EndUser\EndUserInterface;
use App\Http\Traits\Redis\ChefRedis;
use App\Http\Traits\Redis\MealRedis;
use App\Http\Traits\Redis\MenuRedis;
use App\Models\Chef;
use App\Models\ContactUs;
use App\Models\Meal;
use App\Models\Menu;
use function redirect;
use function view;

class EndUserRepository implements EndUserInterface
{
    private $chefModel;
    private $menuModel;
    private $mealModel;

    use ChefRedis, MenuRedis, MealRedis{
        MealRedis::uploadImage insteadof ChefRedis;
    }

    public function __construct(Chef $chef, Menu $menu, Meal $meal)
    {
        $this->chefModel = $chef;
        $this->menuModel = $menu;
        $this->mealModel = $meal;
    }

    public function index()
    {
        $chefs = $this->getChefFromRedis();
        $menus = $this->getMenuFromRedis();
        $meals = $this->getMealFromRedis();
        return view('EndUser.index',compact('chefs','menus','meals'));
    }

    public function gallery()
    {
        $meals = $this->getMealFromRedis();
        return view('EndUser.gallery',compact('meals'));
    }

    public function menu()
    {
        $menus = $this->getMenuFromRedis();
        return view('EndUser.menu',compact('menus'));
    }

    public function chef()
    {
        $chefs = $this->getChefFromRedis();
        return view('EndUser.chefs',compact('chefs'));
    }

    public function contact()
    {
        return view('EndUser.contact');
    }

    public function storeUserMessage($request)
    {
        ContactUs::create($request->validated());
        return redirect(route('endUser.index'));
    }
}
