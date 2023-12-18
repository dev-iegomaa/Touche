<?php

namespace App\Http\Interfaces\Web\EndUser;

interface EndUserInterface
{
    public function index();
    public function menu();
    public function gallery();
    public function chef();
    public function contact();
    public function storeUserMessage($request);
}
