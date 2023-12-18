<?php

namespace App\Http\Traits;
trait MealTrait
{
    private function mealRecord($id)
    {
        return $this->mealModel::find($id);
    }

    private function mealRecords()
    {
        return $this->mealModel::get();
    }

    private function uploadImage($file, $path, $oldImage = null)
    {
        $fileName = time() . '_meal.' . $file->extension();

        if (!is_null($oldImage)) {
            unlink(public_path($oldImage));
        }
        $file->move(public_path('uploaded/' . $path),$fileName);
        return $fileName;
    }

}
