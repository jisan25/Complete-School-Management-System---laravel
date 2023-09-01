<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserView()
    {
        // $all['data'] = User::all();
        $all['data'] = User::where('usertype', 'admin')->get();
        return view('backend.user.view_user', $all);
    }
    public function AddUser()
    {
        return view('backend.user.add_user');
    }
    public function StoreUser(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);
        $data = new User();
        $code = rand(00000, 99999);
        $data->usertype = 'admin';
        $data->name = $request->name;
        $data->email = $request->email;
        $data->code = $code;
        $data->role = $request->role;
        $data->password = bcrypt($code);
        $data->save();

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }
    public function EditUser($id)
    {
        $all['data'] = User::findOrFail($id);
        return view('backend.user.edit_user', $all);
    }
    public function UpdateUser(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',

        ]);

        User::findOrFail($id)->update([
            'usertype' => $request->usertype,
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email
        ]);
        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')->with($notification);
    }
    public function DeleteUser($id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
