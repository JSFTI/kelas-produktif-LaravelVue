<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationErrorSingularException;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request){
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_ARGON2ID);
        $user->save();

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->regenerate();
            return response()->json(Auth::user());
        }
        return response()->json([
            'status' => 'failed',
            'reason' => 'Registration session failed to initialize'
        ], 500);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Harap masukkan username atau email Anda',
            'username.password' => 'Harap masukkan password Anda'
        ]);

        if($validator->fails()){
            throw new ValidationErrorSingularException($validator);
            return;
        }

        if(Auth::attempt([
            filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->username,
            'password' => $request->password    
        ])){
            $request->session()->regenerate();
            return response()->json(Auth::user());
        }
        return response()->json([
            'error' => 'Unauthorized authentication',
            'messages' => [
                'status' => 'Username/email atau password tidak benar.'
            ]
        ], 422);
    }

    public function logout(Request $request){
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerate();
            return response()->json(['status' => 'success']);
        }
        return response()->json([
            'status' => 'failed',
            'reason' => 'No authenticated session'
        ], 400);
    }
}
