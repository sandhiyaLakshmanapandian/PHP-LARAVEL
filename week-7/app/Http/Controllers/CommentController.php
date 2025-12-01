<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BlogComment as Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);

        try {
            // Create a new comment
            $comment = Comment::create([
                'blog_id' => $blog->id,
                'user_id' => Auth::id(),
                'comment' => $request->comment,
            ]); 
            // INSERT INTO `blog_comments` (`blog_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES (?, ?, ?, NOW(), NOW())

            return response()->json([
                'id' => $comment->id,
                'comment' => $comment->comment,
                'user' => [
                    'name' => Auth::user()->name,
                ],
                'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save comment.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Blog $blog)
    {
        try {
            // Get all comments for a blog with user
            $comments = $blog->comments()->with('user')->orderBy('created_at', 'desc')->get();
            // SELECT blog_comments.*, users.id AS user_id, users.name
            // FROM blog_comments
            // LEFT JOIN users ON users.id = blog_comments.user_id
            // WHERE blog_comments.blog_id = ?
            // ORDER BY blog_comments.created_at DESC

            return response()->json($comments);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch comments.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Comment $comment)
    {
        try {
            $comment->load('user');
            // SELECT blog_comments.*, users.id AS user_id, users.name
            // FROM blog_comments
            // LEFT JOIN users ON users.id = blog_comments.user_id
            // WHERE blog_comments.id = ?

            return response()->json($comment);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch comment.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
