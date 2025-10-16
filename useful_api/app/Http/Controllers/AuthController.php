<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register (Request $request) {

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string',

        ]);

        $user = User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make($validated['password']),

        ]);

        return response()->json([

            'id'    => $user->id,
                'name'    => $user->name,
                'email'    => $user->email,
                'created_at'    => $user->created_at,
        ]

        , 201);

    }

    public function login (Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {

            return response()->json([
                'message' => 'The credentials is invalide',
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token'   => $token,
            'user_id'    => $user->id,
        ]);

    }
}









