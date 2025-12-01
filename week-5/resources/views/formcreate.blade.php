@extends('layouts.app')

@section('content')
<div class="container col-md-8">

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4>Create Blog</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="5" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-success">Create Blog</button>
                <a href="{{ route('formindex') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>

</div>
@endsection
