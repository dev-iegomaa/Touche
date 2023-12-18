<?php

namespace App\Http\Repositories\Api\Admin;

use App\Http\Interfaces\Api\Admin\ApiMealInterface;
use App\Http\Traits\Api\apiResponse;
use App\Http\Traits\Redis\MealRedis;
use App\Models\Meal;
use Illuminate\Support\Facades\Validator;

class ApiMealRepository implements ApiMealInterface
{

    use apiResponse, MealRedis;

    private $mealModel;
    public function __construct(Meal $meal)
    {
        $this->mealModel = $meal;
    }

    public function index()
    {
        $meals = $this->getMealFromRedis();
        return $this->apiResponse(200,'Meals Data', $meals);
    }

    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:meals,name',
            'image' => 'required|mimes:png,jpg,jpeg,webp',
            'type'  => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $imageName = $this->uploadImage($request->image,'meal');

        $meal = $this->mealModel::create([
            'name'  => $request->name,
            'type'  => $request->type,
            'image' => $imageName,
        ]);

        $this->setMealToRedis();
        return $this->apiResponse(200, 'Meal Was Created :)', $meal);

    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required|exists:meals,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $this->mealRecord($request->id)->delete();

        $this->setMealToRedis();
        return $this->apiResponse(200, 'Meal Was Deleted :)');
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:meals,name,' . $request->id,
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $meal = $this->mealRecord($request->id);
        if (!is_null($request->image)) {
            $imageName = $this->uploadImage($request->image,'meal', $meal->image);
        }

        if (!is_null($request->type)) {
            $type = $request->type;
        }

        $meal->update([
            'name'  => $request->name,
            'type'  => (isset($type)) ? $type : $meal->type,
            'image' => (isset($imageName)) ? $imageName : $meal->image,
        ]);

        $this->setMealToRedis();
        return $this->apiResponse(200, 'Meal Was Updated :)');
    }

}
