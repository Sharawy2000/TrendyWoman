<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Cache;
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

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number=$request->phone_number;
        $user->is_active=false;
        $user->activation_code=$code;
        $user->save();

        return response()->json($user, 201);
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
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (auth()->user()->email_verified_at==null){

            return response()->json(['error' => 'Pending Unauthorized'], 401);
        }

        $user=User::where('id',auth()->user()->id);
        $user->update(['is_active'=>true]);

        return $this->respondWithToken($token);
    }

 
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_phone(Request $request,$phone)
    {
        $request->validate([
            'code'=>'required|numeric',
        ]);

        $user=User::where('phone_number',$phone)->first();
        
        if($user){

            if ($user->activation_code==$request->code){

                $user->update(['email_verified_at'=>now()]);

                return response()->json(['message' => 'Successfully','user' => $user]);

            }
            
            else{

                return response()->json(['error' => 'Code Unauthorized'], 401);


            }
        
        }else{
            return response()->json(['error' => 'User Unauthorized'], 401);


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
            
        Cache::put('phone_number' . $user->id, $request->phone_number, now()->addMinutes(10));

        $code=111111;
        $reset=new ResetPassword();
        $reset->user_id=$user->id;
        $reset->code=$code;
        $reset->save();

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

        if (!$reset->code==$request->code) {

            return response_data("","Code is not correct",404);
        }

        $newPhoneNumber = Cache::get('phone_number' . $user->id);

        $user=User::find($user->id);
        
        $user->update(['phone_number'=>$newPhoneNumber]);

        Cache::forget('phone_number' . $user->id);

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

            return response()->json(['message'=>'Succefully updated']);
            
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
        return response()->json(auth()->user());
    }
 
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user=User::where('id',auth()->user()->id);
        $user->update(['is_active'=>false]);

        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
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