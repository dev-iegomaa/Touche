<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\AdminInterface;
use function view;

class AdminRepository implements AdminInterface
{
    public function index()
    {
        return view('Admin.index');
    }
}
