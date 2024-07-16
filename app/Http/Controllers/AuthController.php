<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }
    public function loginPost(Request $request){
        $request->validate([
            'phone_number' => 'required|numeric',
            'password' => 'required'
        ]);
        $user = User::where('phone_number',$request->phone_number)->first();
        if($user){
            if($user->password == $request->password){
                $request->session()->put('user',$user);
                return redirect()->route('home');
            }
            else{
                return redirect()->back()->with('error','Password is incorrect');
            }
        }
        else{
            return redirect()->back()->with('error','User not found');
        }

    }

    public function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'phone_number' => 'required|numeric',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->save();

        event(new Registered($user));
        return redirect()->route('phone-confirm');
        // return redirect()->route('login');


    }
}
