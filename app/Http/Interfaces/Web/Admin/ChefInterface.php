<?php

namespace App\Http\Interfaces\Web\Admin;

interface ChefInterface
{
    public function index();
    public function create();
    public function store($request);
    public function delete($request);
    public function update($chef_id);
    public function edit($request);
}
