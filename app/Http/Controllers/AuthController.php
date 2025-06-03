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
            // Convert to object with all properties
            $adminUser = (object) [
                'id' => $admin->id ?? null,
                'username' => $admin->username,
                'nama' => $admin->nama ?? $admin->username,
                'email' => $admin->email ?? null,
                'photo' => $admin->photo ?? null
            ];
            Session::put('user', $adminUser);
            Session::put('level', 'ADM');
            return redirect()->route('admin.dashboard');
        }

        // Check dosen by NIP
        $dosen = DB::table('dosen')->where('nip', $input['login_id'])->first();
        if ($dosen && Hash::check($input['password'], $dosen->password)) {
            // Convert to object with all properties
            $dosenUser = (object) [
                'id' => $dosen->id ?? null,
                'nip' => $dosen->nip,
                'nama' => $dosen->nama,
                'email' => $dosen->email ?? null,
                'photo' => $dosen->photo ?? null
            ];
            Session::put('user', $dosenUser);
            Session::put('level', 'DSN');
            return redirect()->route('dosen.dashboard');
        }

        // Check mahasiswa by NIM
        $mahasiswa = DB::table('mahasiswa')->where('nim', $input['login_id'])->first();
        if ($mahasiswa && Hash::check($input['password'], $mahasiswa->password)) {
            // Convert to object with all properties
            $mahasiswaUser = (object) [
                'id' => $mahasiswa->id ?? null,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'email' => $mahasiswa->email ?? null,
                'photo' => $mahasiswa->photo ?? null,
                'prodi' => $mahasiswa->prodi ?? null
            ];
            Session::put('user', $mahasiswaUser);
            Session::put('level', 'MHS');
            return redirect()->route('mahasiswa.dashboard');
        }

        return redirect()->back()->withErrors(['login' => 'Login ID or password is incorrect']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email',
            'password' => 'required|min:6',
        ]);

        // Insert new mahasiswa
        DB::table('mahasiswa')->insert([
            'nim' => $request->nim,
            'nama' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        // Clear all session data
        Session::flush();
        
        // Regenerate session ID for security
        $request->session()->regenerate();
        
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
