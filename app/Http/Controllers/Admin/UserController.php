<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * The current password being used by the factory.
     */
    protected static string $password;

    public function index(Request $request)
    {
        $users = User::withTrashed()->get();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $permanent = false)
    {
        try {
            $user = User::withTrashed()->where('id', $id)->first();

            if(!$user){
                flash('There was an error when trying to delete the blog. Please try again.', 'danger')->important();
                return redirect()->back();
            }

            $message = 'User '.($permanent ? 'Permanently ' : '').'Deleted Successfully!';

            if(!$permanent){
                $user->delete();
            } else {
                $user->forceDelete();
            }

            flash($message, 'success');
        } catch (\Exception $e) {
            flash('There was an error when trying to delete the blog. Please try again.', 'error')->important();
            \Bugsnag::notifyException($e);
        }

        return redirect()->route('users.index');
    }

    /**
     * Restore a user
     *
     * @param string  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try {
            $user = User::withTrashed()->where('id', $id)->first();

            if(!$user){
                flash('No blog was found. Please try again.');
                return redirect()->back();
            }

            $user->restore();

            flash('User Successfully Restored!', 'success');
        } catch (\Exception $e) {
            \Bugsnag::notifyException($e);
        }

        return redirect()->route('users.index');
    }
}
