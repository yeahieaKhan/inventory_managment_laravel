<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UserContorller extends Controller
{
    //
    public function UserResigtation(Request $request){
        // return $request->all();
        try{

            User::create( [
                'firstName' =>$request->input('firstName'),
                'lastName' =>$request->input('lastName'),
                'email' =>$request->input('email'),
                'password' => $request->input('password'),
                'number' =>$request->input('number'),
                'otp'=>$request->input('otp')


            ]);
            return response()->json(data: [
                "status" => "Insert",
                "message" =>'user resigtation success'
            ]);
        }
        catch(Exception  $e){
            return response()->json(data: [
                "status" => "fail",
                "message" =>$e->getMessage()
            ]);
        }


    }
    public function UserLogin(Request $request) {
        $counte = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))->count(); // Issue: Direct password comparison
    
       
        if($counte ==1){
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'successful',
                'massage' => "login success", 
                'token' => '$token' 
            ]);
        }
        else{
            return response()->json([
                'status' => 'fail',
                "massage" =>"login fail"
            ]);
     
        }
       
       
        
    }
    
}
