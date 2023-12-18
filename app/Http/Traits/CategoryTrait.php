<?php

namespace App\Http\Traits;

trait CategoryTrait
{
    private function categoryRecord($id)
    {
        return $this->categoryModel::find($id);
    }

    private function categoryRecords()
    {
        return $this->categoryModel::get();
    }
}
