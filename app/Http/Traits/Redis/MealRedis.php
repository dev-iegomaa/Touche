<?php

namespace App\Http\Traits\Redis;

use App\Http\Traits\MealTrait;
use Illuminate\Support\Facades\Redis;

trait MealRedis
{

    use MealTrait;

    /**
     * @return bool
     * 1- Connection To Redis
     * 2- Get Meal Data
     * 3- Send Data To Redis
     */
    private function setMealToRedis(): bool
    {
        $redis = Redis::connection();
        $data  = $this->mealRecords();
        $redis->set('meals',$data);
        return true;
    }

    /**
     * @return mixed
     *
     */
    private function getMealFromRedis()
    {
        $redis = Redis::connection();
        $data  = json_decode($redis->get('meals'));

        if (empty($data)) {
            $data = $this->mealRecords();
        }
        return $data;
    }

}
