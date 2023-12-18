<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\MealInterface;
use App\Http\Traits\Redis\MealRedis;
use App\Models\Meal;
use function back;
use function redirect;
use function toast;
use function view;

class MealRepository implements MealInterface
{
    private $mealModel;
    use MealRedis;

    public function __construct(Meal $meal)
    {
        $this->mealModel = $meal;
    }

    public function index()
    {
        $meals = $this->getMealFromRedis();
        return view('Admin.meal.index', compact('meals'));
    }

    public function create()
    {
        return view('Admin.meal.create');
    }

    public function store($request)
    {
        $imageName = $this->uploadImage($request->image, 'meal');

        $this->mealModel::create([
            'image' => $imageName,
            'name' => $request->name,
            'type' => $request->type
        ]);

        $this->setMealToRedis();
        toast('Meal Was Created !','success');
        return redirect(route('admin.meal.index'));
    }

    public function delete($request)
    {
        $meal = $this->mealRecord($request->id);
        unlink(public_path($meal->image));

        $meal->delete();
        $this->setMealToRedis();
        toast('Meal Was Deleted !','success');
        return back();
    }

    public function update($meal_id)
    {
        $meal = $this->mealRecord($meal_id);
        return view('Admin.meal.edit', compact('meal'));
    }

    public function edit($request)
    {
        $meal = $this->mealRecord($request->id);
        $file = $request->image;

        if (!is_null($request->image)) {
            $imageName = $this->uploadImage($file, 'meal', $meal->image);
        }

        $meal->update([
            'name' => $request->name,
            'type' => $request->type,
            'image' => (isset($imageName)) ? $imageName : $meal->getRawOriginal('image')
        ]);

        $this->setMealToRedis();
        toast('Meal Was Updated !','success');
        return redirect(route('admin.meal.index'));
    }
}
