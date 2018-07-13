<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as Controller;
use Validator;

class AuthUserController extends Controller
{
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();

        return response()->json(['success' => $user], 200);
    }

    /**
     * Login
     * 
     * @param string $email (required)
     * @param string $password (required)
     * 
     * @return array $data = [
     *      'name'  => '',
     *      'email' => '',
     *      'token' => ''
     * ]
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken(request('email'))->accessToken;
            $success['name']  = $user->name;
            $success['email'] = $user->email;

            return response()->json([
                'status' => true,
                'code'   => 0,
                'msg'    => 'success',
                'data'   => $success
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'code'   => -1,
                'msg'    => 'Login error',
                'data'   => []
            ], 401);
        }
    }
    /**
     * Register api
     * 
     * @param string $name (required)
     * @param string $email (required)
     * @param string $password (required)
     * @param string $c_password (required)
     *
     * @return array $data = [
     *      'name'  => '',
     *      'email' => '',
     *      'token' => ''
     * ]
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'email'      => 'required|email',
            'password'   => 'required',
            'c_password' => 'required|same:password',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code'   => -1,
                'msg'    => 'Register error',
                'data'   => $validator->errors()->toArray()
            ], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $success['token'] = $user->createToken($user->email)->accessToken;
        $success['name']  = $user->name;
        $success['email'] = $user->email;
 
        return response()->json([
            'status' => true,
            'code'   => 0,
            'msg'    => 'success',
            'data'   => $success
        ], 200);
    }
}
