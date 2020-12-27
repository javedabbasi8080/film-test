<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use App\User; 
use Validator;

class AuthController extends Controller
{
    /**
     * login api 
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $request = \Request::all();
        $validator = Validator::make($request, [ 
            'email' => 'required|email', 
            'password' => 'required', 
        ]);

        // if vlaidtion fails
        if ($validator->fails()) { 
            return response()->json([
                'status'  => False,
                'code'    => 401,
                'error'   => $validator->errors(),
                // 'message' => 'Logged in Fail'
            ], 401);            
        }
        // parameters for login
        $request = ['email' => request('email'), 'password' => request('password')];

        // if auth success then create token
        if(Auth::attempt($request)){ 

            $user = Auth::user(); 
            $token['token_type'] =  'Bearer'; 
            $token['token'] =  $user->createToken('Film')->accessToken; 
  
            $token['user_details'] =  $user; 
            return response()->json([
                'status'  => TRUE,
                'code'    => 200,
                'data'    => $token,
                'message' => 'Logged in successfully'
            ], 200); 

        }else{ 
            return response()->json([
                'status'  => False,
                'code'    => 401,
                'error'   => 'Unauthorised'
            ], 401); 
        } 
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name'         => 'required', 
            'email'        => 'required|unique:users,email', 
            'password'     => 'required', 
            'confirm_pass' => 'required|same:password', 
        ]);

        // if vlaidtion fails
        if ($validator->fails()) { 
            return response()->json([
                'status'  => False,
                'code'    => 401,
                'error'   => $validator->errors(),
                // 'message' => 'Logged in Fail'
            ], 401);            
        }

        // all user inputs
        $input = $request->all();
        $input['password'] = Hash::make($input['password']); 
        unset($input['confirm_pass']);
        // save user in table
        $user = User::create($input); 
        $success['token_type'] =  'Bearer'; 
        $success['token']   =  $user->createToken('Film')->accessToken;
        $success['user_details']    =  $user;

        return response()->json([
            'status'  => TRUE,
            'code'    => 200,
            'data'    => $success,
            'message' => 'Registration in successfully'
        ],200); 
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
