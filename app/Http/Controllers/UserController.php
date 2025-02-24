<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'section' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
            'date_of_join' => 'nullable|date',
            'date_of_birth' => 'nullable|date',
            'occupation' => 'nullable|string|max:255',
            'role' => 'required|in:admin,trainer,participant',
            'cc' => 'nullable|string|max:5',
            'ltc' => 'nullable|in:aluminium,steel,common',
            'sex' => 'required|string|in:male,female',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'section' => $request->section,
            'department' => $request->department,
            'division' => $request->division,
            'date_of_join' => $request->date_of_join,
            'date_of_birth' => $request->date_of_birth,
            'occupation' => $request->occupation,
            'role' => $request->role,
            'cc' => $request->cc,
            'ltc' => $request->ltc,
            'sex' => $request->sex,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.admin.users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'section' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
            'date_of_join' => 'nullable|date',
            'date_of_birth' => 'nullable|date',
            'occupation' => 'nullable|string|max:255',
            'role' => 'required|in:admin,trainer,participant',
            'cc' => 'nullable|string|max:5',
            'ltc' => 'nullable|in:aluminium,steel,common',
            'sex' => 'nullable|string|in:male,female',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
