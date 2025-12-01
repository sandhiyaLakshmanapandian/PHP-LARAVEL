<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('create-blog', function($user) {
    return $user->can('blog_write') || $user->hasRole('Admin');
});

Gate::define('edit-blog', function($user, Blog $blog) {
    return $user->can('user_profile_write') || $blog->user_id === $user->id || $user->hasRole('Admin');
});

Gate::define('delete-blog', function($user, Blog $blog) {
    return $user->can('user_profile_write') || $blog->user_id === $user->id || $user->hasRole('Admin');
});

Gate::define('view-user', function (User $user, User $profile) {
    return 
        $user->can('user_profile_read')    // user has permission to read users
        || $user->id === $profile->id      // user can view own profile
        || $user->hasRole('Admin');        // admin full access
});

Gate::define('edit-user', function (User $user, User $profile) {
    return 
        $user->can('user_profile_write')   // user can edit if they have permission
        || $user->hasRole('Admin');        // admin full access
});

Gate::define('user-profile-read', function (User $user) {
        return $user->hasPermissionTo('user_profile_read') || $user->hasRole('Admin');
    });

    Gate::define('user-profile-write', function (User $user) {
        return $user->hasPermissionTo('user_profile_write') || $user->hasRole('Admin');
    });

    Gate::define('blog-read', function (User $user) {
        return $user->hasPermissionTo('blog_read') || $user->hasRole('Admin');
    });

    Gate::define('blog-write', function (User $user) {
        return $user->hasPermissionTo('blog_write') || $user->hasRole('Admin');
    });

}
}