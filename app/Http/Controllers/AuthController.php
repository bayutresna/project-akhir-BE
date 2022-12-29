<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $req)
    {
    // ngambil data dari inputan user
        $email = $req->input('email');
        $password = $req->input('password');
        // mencari data user berdasarkan email
        $user = User::with('role')->where('email', $email)->first();

        // if (!$user) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'email tidak ditemukan',
        //         'data' => null
        //     ]);
        // }
        // if (!Hash::check($password, $user->password)) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'password salah',
        //         'data' => null
        //     ]);
        // }

        $token = $user->createToken("auth_token");
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'auth' =>[
                    'token' => $token->plainTextToken,
                    'token_type' =>'Bearer'
                ],
                'user' =>$user
                ]
        ]);
    }

    function getUser(Request $req){
        $user = User::with('role')->get()->where('isdeleted',false);
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $user
        ]);
    }

    function register(Request $req){
        $payload = $req->all();
        // dd($payload);
        $payload['id_role'] = 2;
        if (!isset($payload['email'])) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }

        if (!isset($payload['password'])) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }
        $user = User::query()->create($payload);

        return response()->json([
            'status' => true,
            'message' => 'data sudah masuk',
            'data' => $user
        ]);
    }
}
