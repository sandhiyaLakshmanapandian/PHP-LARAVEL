<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
{
    $this->middleware('permission:user_profile_read')->only(['index', 'show']);
    $this->middleware('permission:user_profile_write')->only(['create', 'store', 'edit', 'update', 'destroy']);
}
    public function index()
    {
     
    $users = User::with('roles')->paginate(10);
    return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!Gate::allows('user-profile-write')) {
            abort(403, 'Unauthorized');
        }

        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('user-profile-write')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);
        $user->syncPermissions($request->permissions ?? []);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        if (!Gate::allows('user-profile-read')) {
            abort(403, 'Unauthorized');
        }

        $user->load('roles', 'permissions', 'blogs');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!Gate::allows('user-profile-write')) {
            abort(403, 'Unauthorized');
        }

        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        if (!Gate::allows('user-profile-write')) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->syncRoles([$request->role]);
        $user->syncPermissions($request->permissions ?? []);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!Gate::allows('user-profile-write')) {
            abort(403, 'Unauthorized');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
