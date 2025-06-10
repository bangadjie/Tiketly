<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function test()
    {
        return response()->json(['message' => 'Test route is working on user']);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => ['required', Rule::in(['admin', 'pengguna'])],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'defaultpassword',
        ]);

        $users = User::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'email' => $validated['email'],
            'password' => isset($validated['password']) ? bcrypt($validated['password']) : bcrypt('defaultpassword'),
        ]);

        return response()->json($users, 201);
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        return response()->json($users);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'role' => ['sometimes', Rule::in(['admin', 'pengguna'])],
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($users->id),
            ],
            'password' => 'nullable|string|min:8',
        ]);
        $defaultPassword = 'password123';

        $users->update(array_merge(
            $validated,
            $request->has('password') ? ['password' => Hash::make($defaultPassword)] : []
        ));

        return response()->json($users);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
