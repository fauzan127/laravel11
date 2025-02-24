<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthnController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }
    public function authenticate(Request $request){
        // // First verify CAPTCHA
        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => config('services.recaptcha.secret_key'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     'remoteip' => $request->ip(),
        // ]);

        // // If CAPTCHA fails
        // if (!$response->json()['success']) {
        //     return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.']);
        // }

        // Then validate credentials
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Corrected the typo here
        }
        return back()->with('loginError', 'Login Failed! Please check your email or password');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
