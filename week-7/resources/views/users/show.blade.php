@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('User Details') }}</span>
                    <div>
                        @can('users.edit')
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID:</strong> {{ $user->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-3">
                        <strong>Role:</strong>
                        @if($user->roles->count() > 0)
                            <span class="badge bg-primary">{{ $user->roles->pluck('name')->implode(', ') }}</span>
                        @else
                            <span class="text-muted">No role assigned</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <strong>Blogs:</strong>
                        @if($user->blogs->count() > 0)
                            <ul class="list-group mt-2">
                                @foreach($user->blogs as $blog)
                                    <li class="list-group-item">
                                        <a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a>
                                        <small class="text-muted"> - {{ $blog->created_at->format('Y-m-d') }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No blogs</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <strong>Created At:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}
                    </div>
                    <div class="mb-3">
                        <strong>Updated At:</strong> {{ $user->updated_at->format('Y-m-d H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

