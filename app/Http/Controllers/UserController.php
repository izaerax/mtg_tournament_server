<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show(Request $request) {
        $user = $request->user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
