<?php

namespace App\Http\Traits\Redis;

use App\Http\Traits\ChefTrait;
use Illuminate\Support\Facades\Redis;

trait ChefRedis
{

    use ChefTrait;

    private function setChefToRedis()
    {
        $redis = Redis::connection();
        $data  = $this->chefRecords();
        $redis->set('chefs',$data);
        return true;
    }

    private function getChefFromRedis()
    {
        $redis = Redis::connection();
        $data  = json_decode($redis->get('chefs'));
        if (empty($data)) {
            $data = $this->chefRecords();
        }
        return $data;
    }

}
