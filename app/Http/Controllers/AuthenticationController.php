<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginUserRequest;
use App\Http\Controllers\BaseController;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthenticationController extends BaseController
{
    public function login(LoginUserRequest $request)
    {    
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->handleError('The provided credentials are incorrect.', [], 400);
        }
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken; 
        $success['user'] = $user;
        return $this->handleResponse($success, 'User logged-in!');
    }

    public function register(RegisterUserRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $user = User::create($inputs);
        return $this->handleResponse(new UserResource($user), 'users have been created!');
    }
}
