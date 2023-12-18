<?php

namespace App\Http\Interfaces\Web\Admin;

interface ContactInterface
{
    public function index();
    public function delete($request);
}
