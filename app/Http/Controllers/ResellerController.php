<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ResellerController extends Controller
{
    public function createAccount(Request $request){
        
        try{
            $validator=Validator::make($request->all(),[
                'userName'=>'required|unique:resellers,userName',
                'email'=>'required|unique:resellers,email',
                'accountType'=>'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    "message"=>"Error occred in request",
                    "data"=>[]
                ]);
            }
            $password=Str::random(10);
            $Reseller=Reseller::create([
                "userName"=>$request->username,
                "email"=>$request->email,
                "password" => $password,
                "accountType"=>$request->accountType
            ]);
            return response()->json([
                "message"=>"Re-seller account created successfully",
                "data"=>$Reseller
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message"=>"error occured",
                "error"=>$th->getMessage(),
                "data"=>[]
            ]);
        }
    }  
}
