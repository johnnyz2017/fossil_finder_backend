<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function testauth(){
        return response()->json(
            [
                'code' => 200,
                'message' => 'OK'
            ], 200
        );
    }
    //
    public function register(Request $request){
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6'
        ]);

        // if($validator->fails()){
        //     return response()->json([
        //         'statusCode' => 402,
        //         'message' => 'Failed to validate'
        //     ]);
        // }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'email_verified_at' => now(),
        //     'password' => $request->passsword,
        //     // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        $token = $user->createToken($user->email.'-'.now());

        return response()->json(
            [
                'statusCode' => 200,
                'message' => 'OK',
                'data' => $user,
                'token' => $token->accessToken
            ]
        );
    }


    public function login(Request $request){
        // $request->validate([
        //     'email' => 'required | email | exists:users.email',
        //     'password' => 'required'
        // ]);
        $credentials = $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        // return response()->json($request);
        // return $request;

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            // $user = auth()->user(); 
            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
                'statusCode' => 200,
                'user' => $user,
                'token' => $token->accessToken
            ]);
        }else{
            return response()->json([
                'statusCode' => 404,
                'message' => 'invaliad user name or password',
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ //OK
        //     $user = Auth::user();

        //     $token = $user->createToken($user->email.'-'.now());

        //     return response()->json([
        //         'statusCode' => 200,
        //         'user' => $user,
        //         'token' => $token->accessToken
        //     ]);
        // }else{
        //     return response()->json([
        //         'statusCode' => 404,
        //         'message' => 'invaliad user name or password',
        //         'email' => $request->email,
        //         'password' => bcrypt($request->password)
        //     ]);
        // }
    }
}
