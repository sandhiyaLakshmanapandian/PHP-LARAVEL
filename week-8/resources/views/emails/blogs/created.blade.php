@component('mail::message')
# New Blog Created

**Title:** {{ $blog->title }}

**Author:** {{ $blog->user->name }}

**Created At:** {{ $blog->created_at->format('d M Y H:i') }}

@component('mail::button', ['url' => route('blogs.show', $blog->id)])
View Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
