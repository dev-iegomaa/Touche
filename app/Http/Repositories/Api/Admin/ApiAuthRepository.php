<?php

namespace App\Http\Repositories\Api\Admin;

use App\Http\Interfaces\Api\Admin\ApiAuthInterface;
use App\Http\Traits\Api\apiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ApiAuthRepository implements ApiAuthInterface
{

    use apiResponse;
    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }
        if (! $token = auth('api')->attempt($validator->validated())) {
            return $this->apiResponse(401, 'Unauthorized');
        }
        return $this->createNewToken($token);
    }

    public function register($request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string',
        ]);
        if($validator->fails()){
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return $this->apiResponse(200, 'User successfully registered', $user);
    }

    public function logout() {
        auth('api')->logout();
        return $this->apiResponse(200, 'User successfully signed out');
    }

    public function refresh() {
        return $this->apiResponse(200, 'Refresh Data', $this->createNewToken(auth('api')->refresh()));
    }

    public function userProfile() {
        return $this->apiResponse(200, 'User Profile', auth('api')->user());
    }

    private function createNewToken($token){
        $data = [
            'access_token' => $token,
            'user' => auth('api')->user()
        ];
        return $this->apiResponse(401, 'Successful Login', $data);
    }
}
