<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function all_users()
    {
        $users = User::with(['role', 'profile'])->orderBy('id', 'DESC')->get();
        if (count($users) > 0) {
            return response()->json([
                'success' => true,
                'message' => 'User Found Successfully',
                'roles' => $users
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No User Found',
            ]);
        }
    }
}
