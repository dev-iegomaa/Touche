<?php

namespace App\Http\Interfaces\Api\Admin;

interface ApiContactUsInterface
{
    public function index();
    public function delete($request);
}
