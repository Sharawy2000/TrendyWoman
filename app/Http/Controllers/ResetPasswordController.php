<?php

namespace App\Http\Controllers;

use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot_password(Request $request){
        $request->validate([
            'phone_number' => 'required|numeric',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user) {

            $code=111111;

            $old=ResetPassword::where('user_id',$user->id)->first();

            if($old){
                $old->update(['code'=>$code]);
                return response_data($old,"New code is send");

            }

            $reset=new ResetPassword();
            $reset->user_id=$user->id;
            $reset->code=$code;
            $reset->save();

            return response_data($reset,"Code is send");
        } 
        else {
            return response_data("","User not found",401);

        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function check_code(Request $request){
        $request->validate([
            'code'=>'required|numeric',
        ]);
        $reset = ResetPassword::where('code', $request->code)->first();

        // generate random big string token

        $token = bin2hex(random_bytes(32));

        if ($reset) {

            $reset['reset_token']=$token;
            $reset->save();

            return response_data($reset,"code is valid");
        }
        return response_data("","code is invalid",401);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function reset_password(Request $request,$token){

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $reset=ResetPassword::where('reset_token',$token)->first();

        if ($reset){

            $user=User::find($reset->user_id);

            if($user){

                $user->password=Hash::make($request->password);
                $user->save();
                ResetPassword::where('user_id',$user->id)->delete();
    
                return response_data("",'Password changed successfully');

            }else{

                return response_data("","User not found",404);

            }
        }
        else{
                return response_data("","Error, Try process again :(",404);

        }
    
    }
}
