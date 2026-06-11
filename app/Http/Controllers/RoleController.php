<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::with('permissions')->get();

        $permissions = Permission::whereIn('name', $this->sidebarPermissions())->get();

        return view('createRole', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->givePermissionTo($request->permissions);
        }

        return back()->with('success', 'Role Created Successfully');
    }

    public function destroy($id)
    {
        Role::findById($id)->delete();
        return back()->with('success', 'Role Deleted');
    }

    public function edit($id)
    {
        $role = Role::findById($id);

        $permissions = Permission::whereIn('name', $this->sidebarPermissions())->get();

        return view('editRole', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findById($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        // role name update
        $role->name = $request->name;
        $role->save();

        // permissions sync
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role Updated Successfully');
    }


    private function sidebarPermissions()
    {
        return [


            'view_dashboard',



            'add_categories',

            'view_products',
            'add_product',
            'unapproved_products',
            'inventory',




            'view_orders',
            'pending_orders',
            'delivered_orders',
            'cancelled_orders',




            'view_users',
            'view_agents',
            'add_users',




            'wishlist',
            'track_order',
            'my_orders',
            'my_profile',



            'view_inquiries',
            'view_reviews',


            'settings',
            'manage_roles',


            'wishlist',
            'track_order',
            'my_orders',
            

        ];
    }

}
