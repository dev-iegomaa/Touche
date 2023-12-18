<?php

namespace App\Http\Interfaces\Web\Admin;

interface MenuInterface
{
    public function index();
    public function create();
    public function store($request);
    public function delete($request);
    public function update($menu_id);
    public function edit($request);
}
