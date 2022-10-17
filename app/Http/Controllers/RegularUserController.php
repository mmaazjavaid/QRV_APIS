<?php

namespace App\Http\Controllers;


use App\Models\RegularUser;
use App\Models\Card;
use App\Models\CustomLink;
use App\Models\UserSocial;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class RegularUserController extends Controller
{
    

    public function createRegularUsers(Request $request)
    {

        try{


         $validator = Validator::make($request->all(),[
            'userName'=>'required|unique:regular_users,userName',
            'name'=>'required',
            'email'=>'required|unique:regular_users,email'
        ]);


        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }

        
        $password = Hash::make(str::random(10));

        $user = RegularUser::create([

            'name'=>$request->name,
            'userName'=>$request->userName,
            'email'=>$request->email,
            'password'=>$password
        ]); 

        $user = RegularUser::where('id',$user->id)->first();

        return response(['message'=>'user created successfully','data'=>$user],200);

    }

    catch (\Throwable $th) {
            throw $th;
        }


    }

    public function updateUser(Request $request)
    {
        try{

         $validator = Validator::make($request->all(),[
            'userName'=>'unique:regular_users,userName',
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }
           
            //$id=Auth::id();
            $id=1;
        $user = RegularUser::where('id',$id)->first();

           $data=$request->all();
           $data['password']=Hash::make($request->password);

           $user->update($data);

        return response(['message'=>'user updated successfully','data'=>$user],200);

    }

    public function loginReguarUser(Request $request)
    {
         try{

         $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return $messages;
        }

        $user=RegularUser::where('email',$request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password))
        {
          return response(['message'=>'credentials not matched'],200);   
        }
        else
        { 
             return response(['message'=>'successfully Logged in','data'=>$user],200); 
       // return redirect('/Dashboard');
        }
    }

    catch (\Throwable $th) {
            throw $th;
        }

    }

    public function deleteUser()
    {
        //$id=Auth::id();
            $id=1;
        RegularUser::where('id',$id)->delete();

        return response(['message'=>'user deleted successfully'],200);


    }

}
