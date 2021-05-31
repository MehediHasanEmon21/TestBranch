<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $access_token = $user->createToken('app')->accessToken;
            return response()->json([
                'success' => true,
                'message' => 'Login Done Successfully',
                'access_token' => $access_token,
                'auth_user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Error',
            ]);
        }
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);


        $name_list =  explode(" ", $request->name);
        $name_list = array_map('strtolower', $name_list);
        $user_slug = implode("-", $name_list);
        $similar_slug = DB::table('users')->where('slug', 'like', $user_slug . '%')->get();
        if (count($similar_slug) > 0) {
            $slug = $user_slug . '-' . Str::random(30);
        } else {
            $slug = $user_slug;
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $slug);;
        $user->save();

        $access_token = $user->createToken('app')->accessToken;

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Registration Done Successfully',
                'access_token' => $access_token,
                'auth_user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registration Error'
            ]);
        }
    }

    public function user_info()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User Found Successfully',
                'user' => $user
            ], 200);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            $token = Auth::user()->token();
            $token->revoke();
            return response()->json([
                'success' => true,
                'message' => 'User Logout Successfully',
            ], 200);
        }
    }
}
