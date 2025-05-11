<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.auth-form');
    }

    public function login(Request $request)
    {
        $input = $request->only('login_id', 'password');

        // Check admin by username
        $admin = DB::table('admin')->where('username', $input['login_id'])->first();
        if ($admin && Hash::check($input['password'], $admin->password)) {
            Session::put('user', $admin);
            Session::put('level', 'ADM');
            return redirect()->route('admin.dashboard');
        }

        // Check dosen by NIP
        $dosen = DB::table('dosen')->where('nip', $input['login_id'])->first();
        if ($dosen && Hash::check($input['password'], $dosen->password)) {
            Session::put('user', $dosen);
            Session::put('level', 'DSN');
            return redirect()->route('dosen.dashboard');
        }

        // Check mahasiswa by NIM
        $mahasiswa = DB::table('mahasiswa')->where('nim', $input['login_id'])->first();
        if ($mahasiswa && Hash::check($input['password'], $mahasiswa->password)) {
            Session::put('user', $mahasiswa);
            Session::put('level', 'MHS');
            return redirect()->route('mahasiswa.dashboard');
        }

        return redirect()->back()->withErrors(['login' => 'Login ID or password is incorrect']);
    }
}
