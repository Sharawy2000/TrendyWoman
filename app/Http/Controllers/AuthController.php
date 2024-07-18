<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;

// use Validator;
 
 
class AuthController extends Controller
{

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'phone_number'=>'required|unique:users'
        ]);
 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);

        }
        $code=111111;

        //
        $token = bin2hex(random_bytes(32));
        //

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number=$request->phone_number;
        $user->is_active=false;
        $user->activation_code=$code;

        //
        $user->code=$token;
        //

        $user->save();

        return response_data($user,'Successfully signed up ',201);

    }
 
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['phone_number', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response_data('','Unauthorized',401);

        }

        if (auth()->user()->email_verified_at==null){

            return response_data('','Account is not verified',401);
            
        }

        $user=User::where('id',auth()->user()->id)->first();
        $user->update(['is_active'=>true]);

        return $this->respondWithToken($token);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_phone(Request $request,$token)
    {
        $request->validate([
            'code'=>'required|numeric',
        ]);
        
        // code column => verification token 
        $user=User::where('code',$token)->first();
        
        if($user){

            if ($user->activation_code==$request->code){

                $user->update(['email_verified_at'=>now(),'code'=>null]);

                return response_data($user,'Successfully verified');

            }
            
            else{

                return response_data('','Invalid Code',401);

            }
        
        }else{
            return response_data('','User not found',401);

            


        }
    }
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_phone(Request $request)
    {
        $request->validate([
            'password'=>'required|string',
            'phone_number'=>'required|numeric|unique:users',
        ]);
        $user=auth()->user();

        if(!Hash::check($request->password,$user->password)){

            return response_data("","Password is not correct",404);
            
        }
    
        $code=111111;
        $reset=new ResetPassword();
        $reset->user_id=$user->id;
        $reset->code=$code;
        $reset->save();

        $user=User::find($user->id);

        //Another way , store new phone in code column 
        $user->update(['code'=>$request->phone_number]);
        //

    
        return response_data($reset,"Code is Send");
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function phone_code(Request $request){

        $request->validate([
            'code'=>'required|numeric',
        ]);
        
        $user=auth()->user();
        $reset = ResetPassword::where('user_id', $user->id)->first();

        $user=User::find($user->id);

        if (!$reset->code==$request->code) {
            return response_data("","Code is not correct",404);
        }

        
        // $user->update(['phone_number'=>$new_phone]);

        // set new password and set code column null 

        $user->update(['phone_number'=>$user->code,'code'=>null]);

        return response_data($user,"Phone has been changed");

    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function update_profile(Request $request) {
        
        $validator=Validator::make($request->all(),[
            "name"=>'nullable|String|max:50',
            "email"=>'nullable|String|max:50',
            'image'=>'nullable|mimes:jpg,png,jpeg|max:1024',
        ]);
            
        $user = auth()->user();


        if(!$validator->fails()) {

            $user=User::find($user->id);

            $user->update($request->only(["email","name"]));

            
            if ($request->hasFile('image')) {
                
                UpdateImage($request,$user);

            }

            return response_data("",'Succefully updated');

            
        }else{

            return response_data("",$validator->errors(),422);
        
       }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response_data(auth()->user(),"");

    }
 
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user=User::find(auth()->user()->id);
        $user->update(['is_active'=>false]);

        auth()->logout();
        return response_data('',"Successfully logged out");

    }
 
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $user=User::find(auth()->user()->id);
        $user->update(['is_active'=>false,'phone_number'=>Hash::make($user->id)]);
        $user->delete();
        return response_data("","User has been deleted");

    }
 
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user'=>auth()->user(),
        ]);
    }
}