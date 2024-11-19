<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except([
            'logout', 'dashboard'
        ]);

    }

    public function register(){
        return view("auth.register");

    }
    public function store(Request $request)
    {
        // Validasi data formulir
        $request->validate([
            'name' => 'required|string|max:250', 
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mengenkripsi password sebelum disimpan
        ]);

        // Login user
        Auth::login($user); // Otomatis login user setelah registrasi
        $request->session()->regenerate(); // Regenerasi sesi untuk keamanan

        // Menjalankan job untuk mengirimkan email registrasi
        dispatch(new SendRegistrationEmail($user)); // Mengirim email ke user yang baru terdaftar

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->withSuccess('Registrasi dan login berhasil, email telah dikirim.');
    }




    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withSuccess('Successfuly logout');

    }
}
