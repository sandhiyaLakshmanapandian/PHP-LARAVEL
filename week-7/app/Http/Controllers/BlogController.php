<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Eloquent Query:
         * Blog::select(...)->with(...)->withCount(...)->latest()->paginate(10)
         *
         * RAW SQL EQUIVALENT:
         * SELECT id, title, user_id, created_at
         * FROM blogs
         * ORDER BY created_at DESC
         * LIMIT 10 OFFSET X;
         */
        $blogs = Blog::select('id', 'title', 'user_id', 'created_at') // RAW SQL above
            ->with(['user:id,name']) // SELECT id, name FROM users WHERE id IN (...)
            ->withCount('comments')  // SELECT COUNT(*) FROM blog_comments WHERE blog_id = blogs.id
            ->latest()
            ->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        try {

            /**
             * EAGER LOAD to FIX N+1
             *
             * RAW SQL:
             * SELECT id, title, content, user_id FROM blogs WHERE id = ?
             * SELECT id, name FROM users WHERE id = ?
             * SELECT * FROM blog_comments WHERE blog_id = ?
             * SELECT id, name FROM users WHERE id IN (comment_user_ids)
             */
            $blog->load([
                'user:id,name',
                'comments.user:id,name'
            ]);

            /**
             * REQUIRED RAW SQL QUERY (EXPLICIT)
             */
            $rawCommentCount = Blog::withCount('comments')->get();
            return view('blogs.show', [
                'blog' => $blog,
                'rawCommentCount' => $rawCommentCount
            ]);

        } catch (\Exception $e) {
            return redirect()->route('blogs.index')
                ->with('error', 'Could not load blog details.');
        }
    }

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

        /**
         * Eloquent:
         * Blog::create($validated)
         *
         * RAW SQL:
         * INSERT INTO blogs (title, content, user_id, created_at, updated_at)
         * VALUES (?, ?, ?, NOW(), NOW())
         */
        Blog::create($validated);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));//just return the view
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();

        /**
         
         * RAW SQL:
         * UPDATE blogs SET title=?, content=?, updated_at=NOW() WHERE id=?
         */
        $blog->update($validated);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        /**
         
         * DELETE FROM blogs WHERE id = ?
         */
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
