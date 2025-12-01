<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ------------------ INDEX PAGE ------------------------
    public function index()
    {
        $blogs = Auth::user()->blogs()->latest()->paginate(2);;

        session(['blog_count' => $blogs->count()]);

        return view('formindex', compact('blogs'));
    }

    // ------------------ CREATE PAGE ------------------------
    public function create()
    {
        return view('formcreate');
    }

    // ------------------ STORE BLOG ------------------------
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'image'   => 'nullable|image'
        ]);

        $data = $request->only(['title', 'content']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        $this->syncBlogCount();

        return redirect()->route('formindex')
            ->with('success', 'Blog created successfully');
    }

    // ------------------ EDIT PAGE ------------------------
    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

        return view('formedit', compact('blog'));
    }

    // ------------------ UPDATE BLOG ------------------------
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'image'   => 'nullable|image'
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('formindex')
            ->with('success', 'Blog updated successfully');
    }

    // ------------------ DELETE BLOG ------------------------
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        $this->syncBlogCount();

        return redirect()->route('formindex')
            ->with('success', 'Blog deleted successfully');
    }

    // ------------------ SYNC BLOG COUNT ------------------------
    protected function syncBlogCount()
    {
        session(['blog_count' => Auth::user()->blogs()->count()]);
    }
}
