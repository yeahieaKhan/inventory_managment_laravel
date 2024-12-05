<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OtpMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // view page source
    function UserLoginPage(){
        return view('pages.auth.login-page');
    }
    function RegistationPage(){
        return view('pages.auth.registration-page');
    }
    function SendOtpPage(){
        return view('pages.auth.send-otp-page');
    }
    function VerifyOtpPage(){
        return view('pages.auth.verify-otp-page');
    }
    function ResetPasswordPage(){
        return view('pages.auth.reset-pass-page');
    }
    function ProfilePage(){
        return view('pages.dashboard.profile-page');
    }
    




    // auth controller
    function UserRegistration(Request $request){
        try{
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' =>$request->input('lastName'),
                'email'=>$request->input('email'),
                'password' =>$request->input('password'),
                'number'=>$request->input('number')
            ]);
            return response()->json([
                'status' => 'success',
                'massage' => 'User Registration',

            ],200);
        } catch(Exception $e){
            return response()->json([
                'status' => 'success',
                'massage' => 'User Registration',
            ],401);
        }
    }

    function UserLogin(Request $request){
        $count =User::where('email', '=', $request->input('email'))
        ->where('password', '=',  $request->input('password'))
        ->select('id')->first();

        if($count!==null){
            //login jwt issu
            $token=JWTToken::CreateToken($request->input('email'),$count->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successfull'
            ], 200)->cookie('token', $token, time() + 60 * 24 * 30);
            ;

        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'User Login fail'
            ],401);

        }
    }

    // Send otp code user eamil

    function SendOtpCode(Request $request){
        $email = $request->input('email');
        $otp = rand(1000,9999);
        $count = User::where('email','=',$email)->count();


        if($count ==1){

            Mail::to($email)->send(new OTPMail($otp));
            User::where('email','=', $email)->update(['otp' =>$otp]);

            return response()->json([
                'status' => 'success',
                'message' => 'User mail send check your mail'
            ],200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'User failed'
            ],401);
        }
    }
    // Verify otp 

    function VerifyOTP(Request $request){
        $email=$request->input('email');
        $otp=$request->input('otp');
        $count=User::where('email','=',$email)
            ->where('otp','=',$otp)->count();

        if($count==1){
            // Database OTP Update
            User::where('email','=',$email)->update(['otp'=>'0']);

            // Pass Reset Token Issue
            // $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification Successful',
            ],200)->cookie('token',$token,60*24*30);

        }
        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ],status: 401);
        }
    }

    function ResetPassword(Request $request){
        try{
            $email=$request->header('email');
            $password=$request->input('password');
            User::where('email','=',$email)->update([
                'password'=>$password
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (Exception $exception){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong',
            ],401);
        }
    }
    





    function UserLogout(){
        return redirect('/')->cookie('token','',-1);
    }

    function UserProfile(Request $request){
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ],200);
    }

    function UpdateProfile(Request $request){
        try{
            $email=$request->header('email');
            $firstName=$request->input('firstName');
            $lastName=$request->input('lastName');
            $number=$request->input('number');
            $password=$request->input('password');
            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'number'=>$number,
                'password'=>$password
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (Exception $exception){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong',
            ],401);
        }
    }
    
   
}
