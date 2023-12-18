<?php

namespace App\Http\Traits;

trait ContactTrait
{
    private function getMessages()
    {
        return $this->contactModel::get();
    }

    private function getMessage($id)
    {
        return $this->contactModel::find($id);
    }
}
