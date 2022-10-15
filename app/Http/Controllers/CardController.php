<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class CardController extends Controller
{
    
    public function createCard(Request $request)
    {
        try{
         $validator = Validator::make($request->all(),[
            'cardName'=>'required',
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }
        //$userId=Auth::id();
        $userId=1;

        $card = Card::create([
            'cardName'=>$request->cardName,
            'user_id'=>$userId,
            'randomId'=>str::random(10)
        ]); 

        return response(['message'=>'card is created successfully','data'=>$card],200);
        }
    catch (\Throwable $th) {
            throw $th;
        }


    }

    public function updateCard(Request $request)
    {
        try{
         $validator = Validator::make($request->all(),[
            'cardName'=>'required',
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }
        $data=$request->all();

          if($request->coverImg)
        {
            $coverName=rand().'.'. $request->coverImg->getClientOriginalExtension();
            $request->coverImg->move(public_path('images/cover'), $coverName);
            $data['coverImg']=URL::asset('images/cover').'/'.$coverName;

        }

        if($request->profileImg)
        {
            $profileName=rand().'.'. $request->profileImg->getClientOriginalExtension();
            $request->profileImg->move(public_path('images/profile'), $profileName);
            $data['profileImg']=URL::asset('images/profile').'/'.$profileName;
        }


        $card=Card::find($request->id);
        $card->update($data); 

        return response(['message'=>'card is updated successfully','data'=>$card],200);
        }
    catch (\Throwable $th) {
            throw $th;
        }


    }


}
