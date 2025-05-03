<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function register()
    {
        return view('authentication.register');
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function store_register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // Create user
        $user = User::create([
            'name' => $request->first_name. ' '. $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // dd($user);

        // Log in the user
        //Auth::login($user);

        // Redirect to dashboard
        return redirect()->intended('/admin/login');
    }

    public function do_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with this email.',
            ]);
        }
        // dd(($credentials));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin'){
                return redirect()->intended('/admin/product');
            }elseif(Auth::user()->role == 'user'){
                return redirect()->intended('/proposal');
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/login');
    }


}
