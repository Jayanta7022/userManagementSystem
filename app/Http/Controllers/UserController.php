<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // die($request);
        $validated = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|digits:10|unique:users',
            'profile_pic' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'password' => 'required|min:8',
        ]);
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        }
        // echo'<pre>';
        // print_r($profilePicPath);
        // die();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'profile_pic' => $profilePicPath,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:10|unique:users,mobile,' . $user->id,
            'profile_pic' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('profile_pic')) {
            Storage::disk('public')->delete($user->profile_pic);
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        Storage::disk('public')->delete($user->profile_pic);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    public function exportCsv()
    {
        $users = User::all();
        $csvData = fopen('php://output', 'w');
        $fileName = 'users.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');

        fputcsv($csvData, ['ID', 'Name', 'Email', 'Mobile']);
        foreach ($users as $user) {
            fputcsv($csvData, [$user->id, $user->name, $user->email, $user->mobile]);
        }

        fclose($csvData);
        exit;
    }
}

