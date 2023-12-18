<?php

namespace App\Http\Traits\Api;

trait apiResponse
{
    private function apiResponse($code = 200, $message = null, $data = null, $errors = null)
    {
        $array = [
            'status'  => $code,
            'message' => $message
        ];

        if (is_null($data) && !is_null($errors)) {
            $array['errors'] = $errors;
        } elseif (!is_null($data) && is_null($errors)) {
            $array['data'] = $data;
        } else {
            $array['data'] = $data;
            $array['errors'] = $errors;
        }

        return response($array,200);

    }
}
