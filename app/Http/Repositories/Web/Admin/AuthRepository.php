<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function redirect;
use function view;

class AuthRepository implements AuthInterface
{

    public function index()
    {
        return view('Admin.auth.login');
    }

    public function login($request)
    {
        $credentials = $request->only(['email','password']);
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect(route('admin.index'));
        }
        return redirect(route('auth.index'));
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('web')->logout();
        return redirect(route('auth.index'));
    }
}
