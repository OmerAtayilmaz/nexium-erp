<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request){

        // Validate the password
        if( !auth()->attempt($request->only('email','password'))){
            return response()->json(['message'=>'Invalid Credentials'], 401);
        }

        // Generate a new token
        $token = auth()->user()->createToken(
            'authToken',
            ['*'],
            now()->addDays(2)
            )->plainTextToken;

        // Return the token
        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
       
    }

    public function logout(){
        
        //remove logged in user current session token
        auth()->user()->currentAccessToken()->delete();
    }
}
