<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Cookie;

class AuthController extends Controller
{
    // 1. REGISTER
    public function register(Request $request)
{
    // Aturan validasi
    $validator = Validator::make($request->all(), [
        'username' => [
            'required',
            'string',
            'min:3',
            'max:50',
            'unique:users,username',
            'regex:/^[a-z0-9_]+$/', // Hanya boleh huruf kecil, angka, dan underscore. Tanpa spasi.
        ],
        'name' => 'required|string|max:255',
        'nik' => 'required|digits:16|unique:users,nik', // Wajib 16 digit angka dan unik
        'alamat' => 'required|string',
        'email' => 'required|string|email|max:255|unique:users,email',
        'no_hp' => 'required|string|min:10|max:15',
        'password' => 'required|string|min:6|confirmed', // Wajib ada field password_confirmation
    ], [
        // Custom pesan error Bahasa Indonesia jika validasi gagal
        'username.regex' => 'Username harus huruf kecil semua, tanpa spasi, dan tidak boleh mengandung karakter khusus selain underscore (_).',
        'username.unique' => 'Username sudah digunakan.',
        'nik.unique' => 'NIK sudah terdaftar.',
        'nik.digits' => 'NIK harus berkekuatan tepat 16 digit.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Proses insert data ke database MySQL
    $user = User::create([
        'username' => $request->username,
        'name' => $request->name,
        'nik' => $request->nik,
        'alamat' => $request->alamat,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'password' => Hash::make($request->password),
        'role' => 'masyarakat', // Sesuai kesepakatan, default otomatis menjadi masyarakat
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Registrasi masyarakat berhasil!',
        'data' => [
            'username' => $user->username,
            'name' => $user->name,
            'role' => $user->role
        ]
    ], 201);
}
    // 2. LOGIN
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string', 
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Username/Email atau password salah'], 401);
        }

        $user = auth('api')->user();

        $cookie = cookie(
            'jwt_token',
            $token,
            60,
            '/',
            null,
            false,
            true,
            false,
            'Lax'
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'user' => $user,
        ], 200)->withCookie($cookie);
    }

    // 3. LOGOUT
    public function logout()
    {
        auth('api')->logout();

        $cookie = cookie()->forget('jwt_token');

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil logout',
        ], 200)->withCookie($cookie);
    }

    // 4. GET ME
    public function me()
    {
        return response()->json(auth('api')->user(), 200);
    }
}
