<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller {
    public function create() {
        return view('login');
    }

    public function store() {
        $attr = request()->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);
        // dd("here2");
        if(!Auth::attempt($attr)){
            throw ValidationException::withMessages([
                'email'=>'Sorry, credentials do not match'
            ]);
        }
        // dd("here3");

        request()->session()->regenerate();
        // dd("here");
        return redirect('/');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
