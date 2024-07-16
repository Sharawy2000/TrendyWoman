<?php

namespace App\Http\Controllers;

use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function forgot_password(){
        return view('authentications.forgot-password');
    }
    public function forgot_password_process(Request $request){
        $request->validate([
            'phone_number' => 'required|string',
        ]);

        Session::put('phone_number',$request->phone_number);

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user) {
            //create code 
            // $code = rand(100000, 999999);
            $code=111111;
            $reset=new ResetPassword();
            $reset->user_id=$user->id;
            $reset->code=$code;
            $reset->save();

            Session::put('forgot_password_initiated', true);

            return redirect()->route('code.confirm');
        } 
        else {
            return redirect()->back()->with('Not found');
        }
    }
    public function code_view(){
        return view('authentications.code-confirm');
    }
    public function code_process(Request $request){
        $request->validate([
            'code'=>'required|numeric',
        ]);
        $reset_code = ResetPassword::where('code', $request->code)->first();

        // $token = Hash::make($request->code);
    
        if ($reset_code) {
    
            return redirect()->route('change-password');
        }
        return redirect()->back()->with('error', 'Invalid code');
    }
    public function new_password(){
        return view('authentications.new-password');
    }
    public function new_password_process(Request $request){

        $request->validate([
            'phone_number'=>'required|numeric',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::where('phone_number',$request->phone_number)->first();


        if($user){

            $user->password = Hash::make($request->password);
            $user->save();
            ResetPassword::where('user_id',$user->id)->delete();
            return redirect()->route('login')->with('success', 'Password changed successfully');
            
        }else{
            return redirect()->back()->with('errors', 'Invalid phone number');
        }
    
    }

    public function phone_verify(){
        return view('authentications.phone-verify');
    }

    public function phone_verify_process(Request $request){

        $request->validate([
            'phone_number'=>'required|numeric',
            'code'=>'required|numeric',
        ]);

        $user=User::where('phone_number',$request->phone_number)->first();
        
        if($user){

            if ($user->code==$request->code){

                event(new Registered($user));

                return redirect(route('login'));
            }
            
            else{

                return redirect()->back()->with('errors','Code incorrect');
            }
        
        }else{
            return redirect()->back()->with('errors','Phone number incorrect');
        }

    }
}
