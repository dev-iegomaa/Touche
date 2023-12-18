<?php

namespace App\Http\Interfaces\Api\EndUser;

interface ApiUserInterface
{
    public function index();
    public function menu();
    public function gallery();
    public function chef();
    public function contact($request);
}
