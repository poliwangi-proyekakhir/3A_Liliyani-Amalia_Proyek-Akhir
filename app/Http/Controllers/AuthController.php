<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    use RegistersUsers;

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function profileView(Request $request)
    {
        $user = $request->user();

        return view('dashboard.profil.index', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = $request->user();
        $password_lama = $request->password_lama;
        $password_baru = $request->password_baru;
        $oldPasswordValid = Hash::check($password_lama, $user->password);
        $newPasswordValid = $password_baru !== null;
        
        if (isset($request->photo)) {
            $filePath = Storage::disk('local')->put('images', $request->photo);
            $fileName = explode('/', $filePath)[1];

            $user->update([
                // 'username' => $request->username,
                'name' => $request->name,
                'photo' => $fileName,
            ]);

            Alert::success('info', 'Profil berhasil diupdate');
            return back();
        } elseif (isset($password_lama)) {
            if (!$oldPasswordValid) {
                Alert::error('info', 'Password lama salah');
                return back();
            }

            if (!$newPasswordValid) {
                Alert::error('info', 'Password baru harus diisi');
                return back();
            }

            $user->update([
                // 'username' => $request->username,
                'name' => $request->name,
                'password' => Hash::make($password_baru)
            ]);

            Alert::success('info', 'Profil berhasil diupdate');
            return back();
        } elseif (isset($request->name)) {
            // elseif (isset($request->name) && isset($request->username)) {
            $user->update([
                // 'username' => $request->username,
                'name' => $request->name
            ]);

            Alert::success('info', 'Profil berhasil diupdate');
            return back();
        }
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            // 'username' => ['required', 'min:3', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:5']
        ]);


        $validated['password'] = Hash::make($validated['password']);

        $user = User::create([
            'name' =>$request->name,
            // 'username' =>$request->username,
            'password' =>bcrypt($request->password),
        ]);
        $user->roles()->attach(1);

        auth()->login($user);

        Alert::success('info', 'Registrasi Berhasil');
        return redirect()->route('dashboard.index')->with('pesan', 'berhasil register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            // 'username' => ['required'],
            'name' => ['required'],
            'password' => ['required', 'min:5']
        ]);


        // $cekUsername = User::where('username', $validated['username'])->get();
        $cekname = User::where('name', $validated['name'])->get();

        if (count($cekname->all()) > 0 == false) {
            Alert::error('error', 'Akun tidak ditemukan');
            return redirect()->route('user.login.view');
        }

        $passwordValid = Hash::check($request->password, $cekname[0]['password']);
        if (!$passwordValid) {
            Alert::error('error', 'Password salah');
            return redirect()->route('user.login.view');
        }



        if (Auth::attempt($validated)) {
            $user = Auth::user();
            if ($user->roles[0]->name === 'Petugas') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('dashboard.index')->with('pesan', 'berhasil login');
            }
        }

        Alert::success('error', 'Cek Email dan Password');
        return redirect()->route('user.login.view');
    }
}
