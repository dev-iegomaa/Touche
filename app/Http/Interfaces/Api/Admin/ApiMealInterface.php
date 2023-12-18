<?php

namespace App\Http\Interfaces\Api\Admin;

interface ApiMealInterface
{
    public function index();
    public function create($request);
    public function delete($request);
    public function update($request);
}
