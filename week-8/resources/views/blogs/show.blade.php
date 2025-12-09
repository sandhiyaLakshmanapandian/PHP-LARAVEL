@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Blog Details') }}</span>
                    <div>
                        @can('blogs.edit')
                            <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID:</strong> {{ $blog->id }}
                    </div>
                    <div class="mb-3">
                        <strong>Title:</strong> {{ $blog->title }}
                    </div>
                    <div class="mb-3">
                        <strong>Content:</strong>
                        <div class="mt-2 p-3 bg-light rounded">
                            {{ $blog->content }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <strong>Author:</strong> {{ $blog->user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Created At:</strong> {{ $blog->created_at->format('Y-m-d H:i:s') }}
                    </div>
                    <div class="mb-3">
                        <strong>Updated At:</strong> {{ $blog->updated_at->format('Y-m-d H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

