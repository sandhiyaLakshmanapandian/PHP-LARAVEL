@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Welcome, {{ Auth::user()->name }}</h5>
                    <p class="text-muted">Your Blog Count</p>

                    <h2 class="fw-bold text-primary">
                        {{ session('blog_count') ?? 0 }}
                    </h2>

                    <a href="{{ route('formcreate') }}" class="btn btn-success w-100 mt-3">
                        + Create Blog
                    </a>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">All Blogs</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($blogs->count() == 0)
                        <p class="text-muted">No blogs found.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if($blog->image)
                                            <img src="{{ asset('storage/' . $blog->image) }}"
                                                 width="80" height="60"
                                                 class="rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('formshow', $blog->id) }}" class="btn btn-info btn-sm">View</a>

                                        <a href="{{ route('formedit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('blogs.destroy', $blog->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-center mt-3">
    {{ $blogs->links() }}
</div>
</div>
@endsection
