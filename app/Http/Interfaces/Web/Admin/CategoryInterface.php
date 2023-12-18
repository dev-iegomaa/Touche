<?php

namespace App\Http\Interfaces\Web\Admin;

interface CategoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function delete($request);
    public function update($category_id);
    public function edit($request);
}
