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

                    <!-- Comments -->
                    <h3>Comments ({{ $blog->comments->count() }})</h3>
                    <ul id="comments-list">
                        @foreach($blog->comments as $comment)
                            <li id="comment-{{ $comment->id }}">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                                <br><small>{{ $comment->created_at }}</small>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Add comment -->
                    @auth
                    <h4>Add a comment</h4>
                    <form id="comment-form">
                        @csrf
                        <textarea id="comment" name="comment" rows="3" cols="60" class="form-control mb-2"></textarea>
                        <button id="submit-comment" data-blog-id="{{ $blog->id }}" type="button" class="btn btn-primary">
                            Submit (AJAX)
                        </button>
                    </form>
                    @else
                        <p>Please <a href="{{ route('login') }}">login</a> to comment.</p>
                    @endauth

                </div> <!-- card-body -->

            </div> <!-- card -->
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    // Pass the route URL to JS
    const commentStoreUrl = "{{ route('blogs.comments.store', $blog->id) }}";
</script>

<script src="{{ asset('js/comment.js') }}"></script>
@endsection
