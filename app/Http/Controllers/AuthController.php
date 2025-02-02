<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{

    /**
     * Perform the login action
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=> 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Le credenziali non sono corrette']
            ]);
        }
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Le credenziali non sono corrette']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'token'=> $token
        ]);
    }

    /**
     * Perform the logout
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=> 'Logout'
        ]);
    }

    /**
     * Register a new user
     */
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|min:4',
            'email'=>'required|email',
            'password'=> 'required|confirmed|min:3',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            throw ValidationException::withMessages([
                'email' => ['Un utente con questa email é giá registrato']
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'token'=> $token
        ]);
    }
}
