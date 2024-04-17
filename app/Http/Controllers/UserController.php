<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $pass = Hash::make($request->password);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $pass,
        ]);
        return response()->json($user, 200);

    }
}
