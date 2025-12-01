{{-- resources/views/partials/sidebar.blade.php --}}
<div class="sidebar-card">
    <h4>Sidebar</h4>
    @auth
        <p><strong>Role (cached):</strong> {{ is_array($sidebar_user_role) ? implode(', ', $sidebar_user_role) : $sidebar_user_role ?? 'No role' }}</p>
        <p><strong>My blogs (session):</strong> {{ $sidebar_blog_count ?? 0 }}</p>
    @else
        <p>Please login to view your works</p>
    @endauth
</div>


<style>
    .sidebar-card {
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
        max-width: 250px;
        margin-bottom: 20px;
    }

    .sidebar-card h4 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #333;
    }

    .sidebar-card p {
        font-size: 0.95rem;
        margin: 5px 0;
        color: #555;
    }
</style>
