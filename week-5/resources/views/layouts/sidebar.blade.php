<div class="card p-3 mb-3">
<h5>Welcome, {{ Auth::user()->name }}</h5>
<p>Total blogs: {{ session('blog_count', Auth::user()->blogs()->count()) }}</p>
<a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary">Create Blog</a>
</div>