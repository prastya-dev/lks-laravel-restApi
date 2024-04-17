<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){
        $user = User::where('email',$request->email )->first();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(! $user){
            throw ValidationException::withMessages([
                'email' => ['Email incorrect'],
            ]);
        }else if(! Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'password' => ['password incorrect'],
            ]);
        }

        return $user->createToken('email')->plainTextToken;
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'logout success'
        ], 200);
    }


}
