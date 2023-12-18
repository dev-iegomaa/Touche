<?php

namespace App\Http\Repositories\Api\EndUser;

use App\Http\Interfaces\Api\EndUser\ApiAuthEndUserInterface;
use App\Http\Traits\Api\apiResponse;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthEndUserRepository implements ApiAuthEndUserInterface
{

    use apiResponse;
    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:clients,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', null, $validator->errors());
        }

        $credentials = $request->only(['email','password']);

        if (! $token = Auth::guard('client_api')->attempt($credentials)) {
            return $this->apiResponse(401, 'Unauthorized');
        }
        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return $this->apiResponse(200, 'User successfully signed out');
    }

    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error', null, $validator->errors());
        }

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $this->apiResponse(200, 'User successfully registered', $client);
    }

    public function refresh() {
        return $this->apiResponse(200, 'Refresh Data', $this->createNewToken(auth('client_api')->refresh()));
    }

    public function userProfile() {
        return $this->apiResponse(200, 'User Profile', auth('client_api')->user());
    }

    private function createNewToken($token)
    {
        $data = [
            'access_token' => $token,
            'user' => auth('client_api')->user()
        ];
        return $this->apiResponse(200, 'Login', $data);
    }
}
