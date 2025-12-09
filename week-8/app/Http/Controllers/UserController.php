<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')
            ->with(['roles:id,name'])
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the specified resource.
     */
    public function show(User $user)
    {
        $user->load([
            'roles:id,name',
            'blogs:id,title,user_id,created_at',
        ]);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $validated['password'] = Hash::make($validated['password']);
            $roleId = $validated['role'] ?? null;
            unset($validated['role']);

            $user = User::create($validated);

            if ($roleId) {
                $role = Role::find($roleId);
                if ($role) {
                    $user->assignRole($role);
                }
            }

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user: '.$e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->except(['password', 'password_confirmation']),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create user. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::select('id', 'name')->get();
        $user->load('roles:id,name');

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            if (! empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $roleId = $validated['role'] ?? null;
            unset($validated['role']);

            $user->update($validated);

            if ($roleId) {
                $role = Role::find($roleId);
                if ($role) {
                    $user->syncRoles([$role]);
                }
            } else {
                $user->syncRoles([]);
            }

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating user: '.$e->getMessage(), [
                'exception' => $e,
                'user_id' => $user->id,
                'request_data' => $request->except(['password', 'password_confirmation']),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update user. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting user: '.$e->getMessage(), [
                'exception' => $e,
                'user_id' => $user->id,
            ]);

            return redirect()->back()
                ->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
