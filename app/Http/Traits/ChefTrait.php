<?php

namespace App\Http\Traits;
trait ChefTrait
{
    private function chefRecord($id)
    {
        return $this->chefModel::find($id);
    }

    private function chefRecords()
    {
        return $this->chefModel::get();
    }

    private function uploadImage($file, $path, $oldImage = null)
    {
        $fileName = time() . '_chef.' . $file->extension();

        if (!is_null($oldImage)) {
            unlink(public_path($oldImage));
        }
        $file->move(public_path('uploaded/' . $path),$fileName);
        return $fileName;
    }

}
