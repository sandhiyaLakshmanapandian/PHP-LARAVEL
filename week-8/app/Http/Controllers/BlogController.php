<?php

namespace App\Http\Controllers;

use App\Events\BlogCreated;
use App\Events\BlogUpdated;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::select('id', 'title', 'user_id', 'created_at')
            ->with(['user:id,name'])
            ->latest()
            ->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog->load('user:id,name');

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $blog = Blog::create($validated);

        event(new BlogCreated($blog));// Dispatch event after creating

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();

        $blog->update($validated);

        event(new BlogUpdated($blog));// Dispatch event after updating

        return redirect()->route('blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
