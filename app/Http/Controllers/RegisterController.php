<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    public function showLoginForm(){
        return view('register.regis', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:225',
            'username' => ['required', 'min:3', 'max:225', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:225'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']); //password enkripsi

        User::create($validatedData); //validate data
        return redirect('/login')->with('status', 'Registrasi berhasil, silahkan login!');
    }
    
}
