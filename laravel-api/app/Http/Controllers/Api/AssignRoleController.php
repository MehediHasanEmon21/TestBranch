<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignRoleController extends Controller
{

    public function all_assign_role()
    {
        $users = User::where('role_id', '!=', null)->orderBy('id', 'DESC')->get();
        if (count($users) > 0) {
            return response()->json([
                'success' => true,
                'message' => 'All Role Use Successfully',
                'users' => $users
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No User Found',
            ]);
        }
    }


    public function add_assign_role(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required'
        ]);

        $user_id = $request->user_id;
        $is_role_exists = User::where('id', $user_id)->where('role_id', '!=', NULL)->exists();
        if (!$is_role_exists) {
            $user = User::find($user_id);
            $user->role_id = $request->role_id;
            $user->save();
            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Role Added Successfully',
                    'user' => $user
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This User has alredy assign role',
            ]);
        }
    }

    public function update_assign_role(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required'
        ]);

        $user_id = $request->user_id;
        $already_assign_this_role = User::where('id', $user_id)->where('role_id', $request->role_id)->exists();
        if (!$already_assign_this_role) {
            $user = User::find($user_id);
            $user->role_id = $request->role_id;
            $user->save();
            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Role Updated Successfully',
                    'user' => $user
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Already assign this role',
            ]);
        }
    }


    public function update_assign_delete(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if ($user) {
            $user->role_id = NULL;
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'User Role Deleted Successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No User Found',
            ]);
        }
    }
}
