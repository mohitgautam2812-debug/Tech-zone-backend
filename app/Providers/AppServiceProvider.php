<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            $userOnlyPermissions = ['wishlist', 'my_orders', 'my_profile', 'track_order'];

            if (in_array($ability, $userOnlyPermissions)) {
                return null; // Admin ko bypass mat de
            }

            if ($user->hasRole('admin')) {
                return true;
            }
        });


        $permissions = [

            'add_categories',


            'view_products',
            'add_product',
            'unapproved_products',
            'inventory',

            'view_orders',
            'pending_orders',
            'delivered_orders',
            'cancelled_orders',

            'view_users',
            'view_agents',
            'add_users',

            'view_inquiries',
            'view_reviews',

            'settings',
            'manage_roles',

            'wishlist',
            'track_order',
            'my_orders',
           

        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
    }
}