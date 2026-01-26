<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminpasswordchangeController extends Controller
{
   public function adminpasswordchange(){
      return view('Admin.adminpasswordchange.index');
   }


    public function adminpasswordsubmit(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with('error', 'Old password does not match our records.');
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
     // Show admin profile page
    public function adminProfile()
    {
        return view('Admin.profile.index');
    }

    // Update admin profile
    public function adminProfileSubmit(Request $request, $id)
    {
        // Fetch the admin user
        $admin = User::findOrFail($id);

        // Validate request
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update basic info
        $admin->name  = $request->name;
        $admin->email = $request->email;

        // Handle profile image upload
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/admin'), $filename);

            // Delete old image if exists
            if ($admin->image && file_exists(public_path('uploads/admin/' . $admin->image))) {
                @unlink(public_path('uploads/admin/' . $admin->image));
            }

            $admin->image = $filename;
        }

        // Save changes
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
