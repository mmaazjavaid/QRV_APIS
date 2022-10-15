<?php

namespace App\Http\Controllers;


use App\Models\RegularUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class RegularUserController extends Controller
{
    //


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
 
        /* foreach ($data as $key => $req) {

                $user[$key]=$request[$key];

                if($key=='password')
                {
                    $user[$key]=Hash::make($request->password);
                }

            } */
           $user->update($data);

        return response(['message'=>'user updated successfully','data'=>$user],200);

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
