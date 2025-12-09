<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; }
        .title { font-size: 22px; font-weight: bold; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
<div class="card">
    <p class="title">Blog Updated</p>

    <p><span class="label">Title:</span> {{ $blog->title }}</p>
    <p><span class="label">Updated At:</span> {{ $blog->updated_at->format('d M Y H:i') }}</p>
    <p><span class="label">Author:</span> {{ $blog->user->name }}</p>

    <a href="{{ route('blogs.show', $blog->id) }}">
        View Blog
    </a>
</div>
</body>
</html>
