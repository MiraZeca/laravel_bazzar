<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $role = Role::where('name', $request->role)->first();
        $user->role_id = $role->id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User role updated successfully!');
    }
    
    public function uploadProfileImage(Request $request)
{
    // Validacija za sliku, ako je nije postavio, biće greška
    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'profile_image.required' => 'You must upload a profile picture.',
        'profile_image.image' => 'Image must be in jpeg, png, jpg, or gif format.',
        'profile_image.mimes' => 'Supported formats are jpeg, png, jpg, and gif.',
        'profile_image.max' => 'The image must not be larger than 2MB.',
    ]);
    
    $user = Auth::user();
    if (!$user || !($user instanceof \App\Models\User)) {
        return redirect()->back()->with('error', 'You must be logged in as a user.');
    }

    if ($request->hasFile('profile_image')) {
        // Čuva sliku u storage/app/public/images
        $path = $request->file('profile_image')->store('images', 'public');

        // Snima putanju u bazu (npr. "images/ime_slike.jpg")
        $user->profile_image = $path;
        $user->save();

        return redirect()->back()->with('success', 'Profile picture successfully saved!');
    }

    return redirect()->back()->with('error', 'An error occurred while uploading the image.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('delete', 'User deleted successfully.');
    }
}
