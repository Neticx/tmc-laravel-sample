<?php

namespace App\Http\Controllers\Api;

use App\Entities\UserEntity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
{
    public function register(Request $request)
    {
        $payload = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($payload->fails()) {
            $this->response->messages = "Invalid payload";
            $this->response->data =  $payload->failed();
            return $this->response;
        }



        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            $this->response->messages = "User with this email already exist!";
            return $this->response;
        }
        $newUser = new UserEntity();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);


        $user = User::create($newUser->toArray());
        if (!$user) {
            $this->response->messages = "Something wrong. Failed to register user";
            return $this->response;
        }

        $token = $user->createToken($request->name)->plainTextToken;

        $this->response->data = ['token' => $token];
        $this->response->success = true;
        $this->response->messages = 'Success register user';

        return $this->response;
    }

    public function login(Request $request)
    {
        $payload = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($payload->fails()) {
            $this->response->messages = "Invalid payload";
            $this->response->data =  $payload->failed();
            return $this->response;
        }


        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $this->response->messages = 'The provided credentials are incorrect.';
            return $this->response;
        }

        $token = $user->createToken($user->name)->plainTextToken;

        $this->response->data = ['token' => $token];
        $this->response->success = true;
        $this->response->messages = 'Success login user';

        return $this->response;
    }
}
