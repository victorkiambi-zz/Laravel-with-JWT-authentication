<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
 

use JWTAuth;


class ApiController extends Controller
{
    //
    public $loginAfterSignUp = true;

  
 
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
 
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
 
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }
 
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
 
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
 
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ])
        ->header('Authorization', $jwt_token);
        ;

        
    }
 
    public function logout(Request $request)
    {

        // $this->validate($request, [
        //     'token' => 'required'
        // ]);
 
        // return "logout";

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
 
    public function getAuthUser(Request $request)
    {
        // $this->validate($request, [
        //     'token' => 'required'
        // ]);

        // return "stuff";
 
        $user = JWTAuth::authenticate($request->token); 
        return response()->json(['user' => $user]);
    }
   
}
