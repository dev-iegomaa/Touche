<?php

namespace App\Http\Traits\Redis;

use App\Http\Traits\MenuTrait;
use Illuminate\Support\Facades\Redis;

trait MenuRedis
{

    use MenuTrait;

    /**
     * @return bool
     * 1- Open Connection With Redis
     * 2- Fetch Data From Trait
     * 3- Set Data In Redis
     * 4- Return True
     */
    private function setMenuToRedis()
    {
        $redis = Redis::connection();
        $data  = $this->menuRecords();
        $redis->set('menus',$data);
        return true;
    }

    /**
     * @return mixed
     * 1- Open Connection With Redis
     * 2- Fetch Data From Redis
     * 3- Check For Data
     * 4- Return Data
     */
    private function getMenuFromRedis()
    {
        $redis = Redis::connection();
        $data = json_decode($redis->get('menus'));

        if (empty($data)) {
            $data = $this->menuRecords();
        }
        return $data;
    }

}
