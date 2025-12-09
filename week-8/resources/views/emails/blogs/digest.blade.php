@component('mail::message')
# Daily Blog Digest

Here are all blogs created yesterday:

@foreach ($blogs as $blog)
- **{{ $blog->title }}** ({{ $blog->created_at->format('d M Y H:i') }})
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
