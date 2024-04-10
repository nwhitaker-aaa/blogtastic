<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Validator;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('name', 'DESC')->paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    public function create(Request $request)
    {
        $permission = Permission::get();
        $role = Role::pluck('name', 'id')->first();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.create', compact('permission', 'role', 'rolePermissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $permission = $request->input('permission') ?: [];

        $role = Role::create(['name' => $request->input('name')]);
        $role->save();

        $role->permissions()->attach($permission);

        return redirect()->route('roles.index', $role)
            ->with('success', 'Role created successfully');
    }

    public function show()
    {
        $roles = Role::orderBy('name', 'DESC')->paginate(5);

        return view('admin.roles.index', compact('roles'))->with('success', 'Role updated successfully');;
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->permissions()->sync($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
