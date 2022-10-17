<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegularUser;
use App\Models\UserSocial;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Validator;

class UserSocialController extends Controller
{
    public function addUpdateSocialLink(Request $request)
    {
        try
        {


        $validator = Validator::make($request->all(),[
            'linkUrl'=>'required',
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }

        //$Uid=Auth::id();
        $Uid=1;
        $link=UserSocial::where('userId',$Uid)->where('socialId',$request->socialId)->where('cardId',$request->cardId)->first();
        if($link)
        {

          $link->update( $request->all() ); 
                return response(['message'=>'social link updated successfully','data'=>$link],200);
        }
        else
        {
            $data=$request->all();
            $data['userId']=$Uid;
        $link = UserSocial::create( $data );
        return response(['message'=>'social link added successfully','data'=>$link],200);

        }

         }
        catch (\Throwable $th) {
            throw $th;
        
        }
    }


     public function deleteSocialLink(Request $request)
    {
        try 
        {
            UserSocial::where('id',$request->id)->delete();
         return response(['message'=>'social link deleted successfully'],200);

        }
        catch (\Throwable $th)
        {
            throw $th;
        }

    }




}
