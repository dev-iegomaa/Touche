<?php

namespace App\Http\Traits;
trait MenuTrait
{
    private function menuRecord($id)
    {
        return $this->menuModel::find($id);
    }

    private function menuRecords()
    {
        return $this->menuModel::with('category')->get();
    }

}
