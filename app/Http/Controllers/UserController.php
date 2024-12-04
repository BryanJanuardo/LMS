<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function create(Request $request){
        $request->validate([
            'UserName' => 'required|string|max:255|min:5',
            'UserEmail' => 'required|string|max:255|min:5',
            'UserPassword' => 'required|string|max:255|min:5',
            'UserDOB' => 'required|date',
        ]);

        $user = User::create([
            'UserName' => $request->UserName,
            'UserEmail' => $request->UserEmail,
            'UserPassword' => $request->UserPassword,
            'UserDOB' => $request->UserDOB,
            'UserPhotoPath' => null
        ]);

        if(Auth::attempt(['UserEmail' => $request->UserEmail, 'UserPassword' => $request->UserPassword])){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
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

        if($request->UserPassword == $user->UserPassword){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
    }


    public function edit(){

        $user = Auth::user();
        return view('UserProfile', ['user' => $user]);
    }

    public function update(Request $request)
    {

        $user = Auth::user();
        $data = $request->validate([
            'UserName' => 'required|string|max:255',
            'UserEmail' => 'required|string|max:255|email',
            'UserPassword' => 'required|string|min:6',
            'UserDOB' => 'required|date',
        ]);

        $user = User::find($user->id);

        $user->update($data);

        // dd($user);
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

}
