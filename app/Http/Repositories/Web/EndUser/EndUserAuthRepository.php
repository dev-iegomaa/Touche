<?php

namespace App\Http\Repositories\Web\EndUser;

use App\Http\Interfaces\Web\EndUser\EndUserAuthInterface;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function redirect;
use function toast;
use function view;

class EndUserAuthRepository implements EndUserAuthInterface
{
    private $clientModel;
    public function __construct(Client $client)
    {
        $this->clientModel = $client;
    }

    public function login_page()
    {
        return view('EndUser.auth.login');
    }

    public function register_page()
    {
        return view('EndUser.auth.register');
    }

    public function registerData($request)
    {
        $this->clientModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        toast('Welcome Sr In Touche Web Site','success');
        return redirect(route('client.index'));
    }

    public function loginData($request)
    {
        $credentials = $request->only(['email','password']);
        if (Auth::guard('client')->attempt($credentials)) {
            toast('Welcome Again Sr','success');
            return redirect(route('endUser.index'));
        }
        return view('EndUser.auth.login');
    }
}
