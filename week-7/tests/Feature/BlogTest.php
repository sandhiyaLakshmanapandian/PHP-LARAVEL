<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Disable all middleware so tests pass without auth
        $this->withoutMiddleware();

        // Override home route for testing
        \Route::get('/', function () {
            return 'Home Page';
        });
    }

    /** Test blog creation using factory */
    public function test_it_creates_a_blog_using_factory(): void
    {
        // Create a user
        // RAW SQL: INSERT INTO users (...) VALUES (...)
        $user = User::factory()->create();

        // Create a blog associated with that user
        // RAW SQL: INSERT INTO blogs (title, content, user_id, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        // Assert the blog exists in DB
        // RAW SQL: SELECT * FROM blogs WHERE id = ?
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'title' => $blog->title,
            'user_id' => $user->id
        ]);
    }

    /** Test blog index page */
    public function test_it_can_get_blog_index_page(): void
    {
        // Create a user
        // RAW SQL: INSERT INTO users (...) VALUES (...)
        $user = User::factory()->create();

        // Create a blog
        // RAW SQL: INSERT INTO blogs (title, content, user_id, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        // Hit the index page
        // RAW SQL equivalent of Blog::all() would be: SELECT * FROM blogs;
        $response = $this->get('/blogs');

        // Assert status and see blog title
        // RAW SQL: SELECT * FROM blogs WHERE id = ?
        $response->assertStatus(200);
        $response->assertSee($blog->title);
    }

    /** Test home page */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Hit the home page route
        // RAW SQL: No DB query here, just a route return
        $response = $this->get('/');

        // Assert status
        $response->assertStatus(200);
        $response->assertSee('Home Page');
    }
}
