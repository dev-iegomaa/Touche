<?php

namespace App\Http\Interfaces\Api\Admin;

interface ApiCategoryInterface
{
    public function index();
    public function create($request);
    public function delete($request);
    public function update($request);
}
