<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    /**
     * Login admin
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cari admin berdasarkan email di tabel users
        $admin = User::where('email', $request->email)->first();

        // Verifikasi password
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Kredensial tidak valid'
            ], 401);
        }

        // Buat token baru untuk admin
        $token = $admin->createToken('admin_auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login admin berhasil',
            'data' => [
                'admin' => $admin,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        ]);
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout admin berhasil'
        ]);
    }

    /**
     * Profile admin
     */
    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => 'Profil admin',
            'data' => $request->user()
        ]);
    }
}