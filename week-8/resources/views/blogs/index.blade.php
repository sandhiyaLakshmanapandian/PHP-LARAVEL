@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Blogs') }}</span>
                    @can('blogs.create')
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">{{ __('Create Blog') }}</a>
                    @endcan
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>{{ Str::limit($blog->title, 50) }}</td>
                                        <td>{{ $blog->user->name }}</td>
                                        <td>{{ $blog->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <a href="{{ route('blogs.show', $blog) }}" class="btn btn-info btn-sm" title="Show">
                                                Show
                                            </a>
                                            @can('blogs.edit')
                                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @endcan
                                            @can('blogs.destroy')
                                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No blogs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

