<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('cors');
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(Request $request) 
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        
        if(!$user) {    
            return response()->json([
                'error' => 'User does not exist.'
            ], 400);
        }

        if(Hash::check($request->input('password'), $user->password)) {
            $access_token = base64_encode(str_random(32));

            // Update access token
            $user->access_token = $access_token;
            $user->save();

            return response()->json([
                'status' => 'success',
                'data' => $access_token
            ], 200);
        }

        // If all fails
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid email/password.'
        ], 400);
    }

    public function loggedInUser() {
        $user = \Auth::user();

        return response()->json([
            'status' => 'success',
            'data' => $user->toArray()
        ]);
    }
}
