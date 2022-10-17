<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\RegularUser;
use App\Models\CustomLink;

class CustomLinkController extends Controller
{
     public function addCustomLink(Request $request)
    {
        try {
        $validator = Validator::make($request->all(),[
            'linkImg'=>'required',
            'linkName'=>'required',
            'linkUrl'=>'required',
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }

        //$Uid=Auth::id();
        $Uid=1;


        $customLink=CustomLink::where('linkName',$request->linkName)->where('userId',$Uid)->where('cardId',$request->cardId)->first();
        if($customLink)
        { 
             return response(['message'=>'link name already exists'],200);
        }
        else
        {
            $data=$request->all();
            $data['userId']=$Uid;

            $linkImg=rand().'.'. $request->linkImg->getClientOriginalExtension();
            $request->linkImg->move(public_path('images/customLinks'), $linkImg);
            
            $data['linkImg']=URL::asset('images/customLinks').'/'.$linkImg;

            $customLink = CustomLink::create( $data );
        return response(['message'=>'custom link added successfully','data'=>$customLink],200);
        }

    }
    catch (\Throwable $th) {
       throw $th;
        
        }

    }

    public function updateCustomLink(Request $request)
    {
        try{


        $validator = Validator::make($request->all(),[
          //  'linkImg'=>'required',
            'linkName'=>'required',
            'linkUrl'=>'required',
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }

         //$Uid=Auth::id();
        $Uid=1;

        $customLink=CustomLink::where('linkName',$request->linkName)->where('userId',$Uid)->where('cardId',$request->cardId)->first();
        
        if($customLink && $customLink->id!=$request->id)
        { 
             return response(['message'=>'link name already exists'],200);
        }
        
        else
        {
            $customLink=CustomLink::find($request->id);
            $data=$request->all();

            if($request->linkImg)
            {
            $linkImg=rand().'.'. $request->linkImg->getClientOriginalExtension();
            $request->linkImg->move(public_path('images/customLinks'), $linkImg);
            $data['linkImg']=URL::asset('images/customLinks').'/'.$linkImg;
            }
            
          $customLink->update( $data ); 
                return response(['message'=>'custom link updated successfully','data'=>$customLink],200);
        }

        }
        catch (\Throwable $th) {
            throw $th;
        
        }

    }

  

     public function deleteCustomLink(Request $request)
    {
        try
        {
        CustomLink::where('id',$request->id)->delete();
         return response(['message'=>'custom link deleted successfully'],200);

          }
        catch (\Throwable $th) {
            throw $th;
        
        }

    }

}
