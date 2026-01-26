<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserprofileController extends Controller
{
 // Show Profile
    public function profile()
    {
        $user = auth()->user();
        return view('userdashboard.profile.profile', compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'phone'    => 'nullable|string|max:20',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'wallet_address'     => 'required',

        ]);

        // Update fields
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->username = $request->username;
        $user->phone    = $request->phone;
        $user->wallet_address    = $request->wallet_address;


        // Handle profile image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);

            // Delete old image
            if ($user->image && file_exists(public_path('uploads/profile/' . $user->profilimagee_image))) {
                unlink(public_path('uploads/profile/' . $user->image));
            }

            $user->image = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
