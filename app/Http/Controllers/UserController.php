<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('Login');
    }

    public function register(){
        return view('Register');
    }

    public function create(Request $request){
        $request->validate([
            'UserName' => 'required|string|max:255|min:5',
            'UserEmail' => 'required|string|max:255|min:5',
            'UserPassword' => 'required|string|max:255|min:5',
            'UserDOB' => 'required|date',
        ]);

        // dd($request->UserName);

        $credentials = [
            'email' => $request->UserEmail,
            'password' => Hash::make($request->UserPassword)
        ];

        $user = User::create([
            'UserName' => $request->UserName,
            'UserEmail' => $request->UserEmail,
            'UserPassword' => Hash::make($request->UserPassword),
            'UserDOB' => $request->UserDOB,
            'UserPhotoPath' => null
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('dashboard');

    }

    public function auth(Request $request){
        $request->validate([
            'UserEmail' => 'required|string|max:255|min:5',
            'UserPassword' => 'required|string|max:255|min:5',
        ]);

        $user = User::where('UserEmail', $request->UserEmail)->first();

        if($user == null){
            return back();
        }

        $credentials = [
            'UserEmail' => $request->UserEmail,
            'password' => Hash::make($request->UserPassword)
        ];

        if($user->UserEmail == $request->UserEmail && Hash::check($request->UserPassword, $user->UserPassword)){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return redirect()->route('login.index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.index');
    }
}
