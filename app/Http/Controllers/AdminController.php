<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Logout Method
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            "message" => "User is Signed Out",
            "alert-type" => "warning",
        ];

        return redirect("/login")->with($notification);
    }
    // Profile Method
    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view("admin.admin_profile_view", compact("adminData"));
    }

    // Edit Profile Method
    public function edit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view("admin.admin_profile_edit", compact("editData"));
    }

    // Edit Profile Method that allows you to update a profile image
    public function storeProfile(Request $request): RedirectResponse
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->file("profile_image")) {
            $file = $request->file("profile_image");

            $filename = date("YmdHi") . $file->getClientOriginalName();
            $file->move(public_path("upload/admin_images"), $filename);
            $data["profile_image"] = $filename;
        }

        $data->save();

        $notification = [
            "message" => "Admin Profile Updated",
            "alert-type" => "success",
        ];

        return redirect()
            ->route("admin.profile")
            ->with($notification);
    }

    // Method View to update User Password
    public function changePassword()
    {
        return view("admin.admin_change_password");
    }

    // Post Method to update user password
    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            "oldpassword" => "required",
            "newpassword" => "required",
            "confirm_password" => "required|same:newpassword",
        ]);

        $password = Auth::user()->password;
        if (Hash::check($request->oldpassword, $password)) {
            $users = User::find(Auth::id());
            $users->password = Hash::make($request->newpassword);
            $users->save();

            session()->flash("message", "Password Updated Successfully");
            return redirect()->back();
        } else {
            session()->flash("message", " Old Password Does Not Match");
            return redirect()->back();
        }
    }
}
