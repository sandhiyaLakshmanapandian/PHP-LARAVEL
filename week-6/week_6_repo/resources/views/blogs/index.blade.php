@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blogs</h1>

    @can('blog_write')
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create Blog</a>
    @endcan

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->user->name }}</td>
                <td>
                    @can('blog_read')
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm">Show</a>
                    @endcan

                    @can('blog_write')
                        @if(auth()->user()->id == $blog->user_id || auth()->user()->hasRole('Admin'))
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $blogs->links() }}
</div>
@endsection
