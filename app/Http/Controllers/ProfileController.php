<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customers;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{

    public function index()
    {
        $customerprofile = Auth::user();
        return view('profile.index', compact('customerprofile'));
    }

    public function edit($id)
    {
        $profile = Customers::findOrFail($id);
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request, $id)
{
    $customerprofile = Customers::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'address1' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'image_profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], [
        'image_profile.max' => 'The image size cannot exceed 2MB.',
    ]);

    if ($request->hasFile('image_profile')) {
        $image = $request->file('image_profile');
        $imageName = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/profile'), $imageName);

        // Delete old image if it's not the default image
        if ($customerprofile->image_profile && $customerprofile->image_profile != 'default.jpg') {
            Storage::disk('public')->delete($customerprofile->image_profile);
        }

        $customerprofile->image_profile = 'storage/profile/' . $imageName;
    }

    $customerprofile->name = $request->name;
    $customerprofile->address1 = $request->address1;
    $customerprofile->phone = $request->phone;
    $customerprofile->email = $request->email;

    $customerprofile->save();

    return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
}


}
