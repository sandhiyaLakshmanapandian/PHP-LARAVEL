@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Roles:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
    
    <h4>Permissions</h4>
    <ul>
        @foreach($user->permissions as $permission)
            <li>{{ $permission->name }}</li>
        @endforeach
    </ul>

    <h4>Blogs</h4>
    <ul>
        @foreach($user->blogs as $blog)
            <li>{{ $blog->title }}</li>
        @endforeach
    </ul>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>
@endsection
