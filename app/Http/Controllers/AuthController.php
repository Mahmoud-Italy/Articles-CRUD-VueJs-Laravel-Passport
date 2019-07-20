<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Hash;

class AuthController extends Controller
{
	 /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
    	$user = User::where('email', $request->username)->first();
	    if ($user) {

	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            $response = ['access_token' => $token, 'user'=>$user];
	            return response($response, 200);
	        } else {
	            $response = "Password missmatch";
	            return response($response, 422);
	        }

	    } else {
	        $response = 'User does not exist';
	        return response($response, 422);
	    }
    }

    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) 
    {
	    $request->validate([
	        'name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
	        'password' => 'required|string|min:6',
	    ]);

	    $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    $response = ['user'=>$user];

	    return response($response, 200);
	}

	/**
     * Handles logout Request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }


}
