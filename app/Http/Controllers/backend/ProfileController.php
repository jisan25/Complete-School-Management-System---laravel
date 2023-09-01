<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileView()
    {
        $id = Auth::id();
        $data =  User::find($id);
        return view('backend.user.view_profile', compact('data'));
    }
    public function EditProfile()
    {
        $id = Auth::id();
        $data = User::find($id);
        return view('backend.user.edit_profile', compact('data'));
    }
    public function UpdateProfile(Request $request)
    {
        $data = User::find(Auth::id());
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/users/' . $data->image));
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalName();
            $file->move(public_path('upload/users'), $filename);
            $data['image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('profile.view')->with($notification);
    }
    public function PasswordView()
    {
        return view('backend.user.edit_password');
    }
    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $data = User::find(Auth::id());
            $data->password = Hash::make($request->password);
            $data->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }
}
