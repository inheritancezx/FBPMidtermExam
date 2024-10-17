<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class RegisterController extends Controller {
    public function create() {
        return view('register');
    }
    
    public function store(Request $attr) {
        $attr->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=> 'required|string|min:8',
            'confirm-password'=>'required|string|min:8'
        ]);

        $name = $attr->input('name');
        $email = $attr->input('email');
        $password = $attr->input('password');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        // $user = User::create($attr);
        // Auth::login($user);
        // return redirect(route('/login'));
        return redirect()->route('login')->with('success', 'user added successfully!');
    }
}
