<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {

        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        if (count($roles) > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Role Found Successfully',
                'roles' => $roles
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Role Found',
            ]);
        }
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        if ($role) {
            return response()->json([
                'success' => true,
                'message' => 'Role Add Successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong',
            ]);
        }
    }




    public function edit($id)
    {
        $role = Role::find($id);
        if ($role) {
            return response()->json([
                'success' => true,
                'message' => 'Role Found Successfully',
                'role' => $role
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Role Found',
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => 'required|unique:roles',
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        if ($role) {
            return response()->json([
                'success' => true,
                'message' => 'Role Updated Successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return response()->json([
                'success' => true,
                'message' => 'Role Deleted Successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Role Found',
            ]);
        }
    }
}
