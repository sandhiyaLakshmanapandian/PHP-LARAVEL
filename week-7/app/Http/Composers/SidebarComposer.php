<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SidebarComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $roleName = 'guest';
        $blogCount = 0;

        if ($user) {

            // Cache the role for 15 minutes
           
            // Cache the first role name of the user for 15 minutes
           $roleName = Cache::remember('user_roles_'.$user->id, 900, function () use ($user) {
                // Using Spatie method to get all role names
                return $user->getRoleNames(); // returns a collection of role names
        });

            // Blog count can stay dynamic
            $blogCount = $user->blogs()->count();
        }

        $view->with('sidebar_blog_count', $blogCount)
             ->with('sidebar_user_role', $roleName);
    }
}
