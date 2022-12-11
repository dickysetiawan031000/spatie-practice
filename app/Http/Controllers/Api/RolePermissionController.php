<?php

namespace App\Http\Controllers\Api;

use App\Actions\AssignRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\RolePermissionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /*
    assign role
    assign role ke user
    assign role ke permission

    assign permission
    assign permission ke user
    assign permission ke role

    user -> role -> permission
    user -> permission
    permission -> role
    role -> permission
    */

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function check_role_permission(RolePermissionRequest $request)
    {
        $data = $request->validated();

        $user = User::whereName($data['name'])->first();

        // check user's role
        return response()->json([
            'status' => 'success',
            'message' => 'User role',
            'role' => $user->getRoleNames(),
            'permission' => $user->getAllPermissions()->pluck('name')
        ], 200);
    }

    public function create_role(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $role = Role::create([
            'name' => $validator->validated()['name'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'data' => $role
        ], 201);
    }

    public function create_permission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $permission = Permission::create([
            'name' => $validator->validated()['name'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Permission created successfully',
            'data' => $permission
        ], 201);
    }

    public function assign_role(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'exists:' . $request->all()['by'] . ',name'],
            'role' => ['required', 'string', 'max:255', 'exists:roles,name'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::whereName($validator->validated()['name'])->first();

        if (!$user) {
            $user = Permission::whereName($validator->validated()['name'])->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User or permission not found'
                ], 404);
            }
        }


        $user->assignRole($validator->validated()['role']);

        return response()->json([
            'status' => 'success',
            'message' => 'Role assigned successfully',
            'data' => $user
        ], 201);
    }

    public function assign_permission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'permission' => ['required', 'string', 'max:255', 'exists:permissions,name'],
        ]);

        $user = User::whereName($validator->validated()['name'])->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);

            $user = Role::whereName($validator->validated()['name'])->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User or role not found'
                ], 404);
            }
        }


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user->givePermissionTo($validator->validated()['permission']);

        return response()->json([
            'status' => 'success',
            'message' => 'Permission assigned successfully',
            'data' => $user
        ], 201);
    }
}
