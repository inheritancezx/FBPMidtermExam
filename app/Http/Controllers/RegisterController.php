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
    
    public function store() {
        $attr = request()->validate([
            'name'=>['required'],
            'email'=>['required','email'],
            'password'=>['required',Password::min(8),'confirmed']
        ]);
        $user = User::create($attr);
        Auth::login($user);
        return redirect(route('/login'));
    }
}
