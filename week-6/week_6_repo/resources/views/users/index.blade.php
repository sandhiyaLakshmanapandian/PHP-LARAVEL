
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>

    @can('user_profile_write') 
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
    @endcan

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td>{{ $user->permissions->pluck('name')->join(', ') }}</td>
                <td>
                    @can('user_profile_read')
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Show</a>
                        
                    @endcan
                    @can('user_profile_write')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
