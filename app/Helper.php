<?php

use App\Models\User;
use Illuminate\Http\Request;

    if(!function_exists('response_data')){
        function response_data($data,$message="",$status=200){
            return response()->json([
               "message"=>$message,
               "data"=>$data,
               "status"=>$status
            ],$status);
        }
    }

    if (!function_exists('getImageNameFromUrl')) {
        function getImageNameFromUrl($url)
        {
            $parsedUrl = parse_url($url);
            $imagePath = $parsedUrl['path'];
            return basename($imagePath);
        }
    }
    if (!function_exists('UpdateImage')) {
        function UpdateImage(Request $request,$user)
        {
            $img=$user->image;
            $img=getImageNameFromUrl($img);
            // image check 
            if ($img) {
                $path='images/ProfileImage/'.$img;
                
                unlink(public_path($path));
            }
            // image  uploading
            $file=$request->file('image');
            $extension = $file -> getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path='images/ProfileImage';
            $file->move($path , $filename);
            $User=User::findOrFail($user->id);
            $User->image=url($path,$filename);
            $User->save();

        }
    }
    
    
