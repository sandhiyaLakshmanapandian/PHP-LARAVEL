@extends('layouts.app')

@section('content')
<div class="container col-md-8">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h3>{{ $blog->title }}</h3>
        </div>

        <div class="card-body">
            
            @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" 
                 width="100%" class="rounded mb-3">
            @endif

            <p>{{ $blog->content }}</p>

            <a href="{{ route('formindex') }}" class="btn btn-secondary mt-3">Back</a>
        </div>

    </div>

</div>
@endsection
