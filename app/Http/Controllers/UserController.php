<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function list() {
        return UserResource::collection(User::query()->paginate());
    }

    public function show(Request $request) {
        $user = $request->user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
