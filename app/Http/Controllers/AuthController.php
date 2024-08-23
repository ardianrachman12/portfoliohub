<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required',
        ], [
            'identity.required' => 'Email atau username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $identityType = filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $identityType => $request->identity,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // Login berhasil
            return redirect('/dashboard');
        } else {
            // Login gagal
            return redirect()->back()->with('error', 'Email/username atau password salah');
        }
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:20|unique:users|regex:/^[^\s]+$/',
            'email' => 'required|email|unique:users|max:255',
            'phone' => [
                'required',
                'string',
                'regex:/^628[0-9]{8,}$/',
                Rule::unique('users')->ignore($request->user),
            ],
            'password' => 'required',
        ]);
        // Membuat entri baru di model User
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => "user",
            'password' => bcrypt($request->password),
        ]);

        // Membuat entri baru di model UserView

        $ipAddress = $request->ip();
        if ($user) {
            $userView = new UserView(['user_id' => $user->id, 'ipaddress' => $ipAddress]);
            $user->views()->save($userView);
        }
        return redirect()->route('auth.login')->with('success', 'berhasil registrasi');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
