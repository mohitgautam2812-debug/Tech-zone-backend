<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\InquiryContactController;
use App\Http\Controllers\AboutPageController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/send-otp', [AuthController::class, 'sendOtp'])
    ->name('send.otp');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');



Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});




Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class)->except(['edit']);

    Route::get('/products/unapproved', [ProductController::class, 'unapproved'])
        ->name('products.unapproved')
        ->middleware('permission:unapproved_products');

    Route::get('/inventory', [ProductController::class, 'inventory'])
        ->name('inventory')
        ->middleware('permission:inventory');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders')
        ->middleware('permission:view_orders');

    Route::get('/orders/pending', [OrderController::class, 'pending'])
        ->name('orders.pending')
        ->middleware('permission:pending_orders');

    Route::get('/orders/delivered', [OrderController::class, 'delivered'])
        ->name('orders.delivered')
        ->middleware('permission:delivered_orders');

    Route::get('/orders/cancelled', [OrderController::class, 'cancelled'])
        ->name('orders.cancelled')
        ->middleware('permission:cancelled_orders');

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::put('/orders/{order}', [OrderController::class, 'update'])
        ->name('orders.update');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users')
        ->middleware('permission:view_users');

    Route::get('/users/agents', [UserController::class, 'agents'])
        ->name('users.agents')
        ->middleware('permission:view_agents');

    Route::get('/add-user', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('permission:add_users');

    Route::post('/users/store', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('permission:add_users');

    Route::post('/users/status/{id}', [UserController::class, 'updateStatus'])
        ->name('users.status')
        ->middleware('permission:view_users');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:view_users');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/inquiries', [InquiryController::class, 'index'])
        ->name('inquiries')
        ->middleware('permission:view_inquiries');

    Route::post('/inquiries', [InquiryController::class, 'store'])
        ->name('inquiries.store');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/reviews', [ReviewController::class, 'index'])
        ->name('reviews')
        ->middleware('permission:view_reviews');

    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/settings', [ProfileController::class, 'settings'])
        ->name('settings')
        ->middleware('permission:settings');

    Route::post('/settings/update', [ProfileController::class, 'updateProfile'])
        ->name('settings.update');

});




Route::middleware(['auth'])->group(function () {

    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('permission:manage_roles');

    Route::post('/roles/store', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('permission:manage_roles');

    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('permission:manage_roles');

    Route::post('/roles/{id}/update', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('permission:manage_roles');

    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])
        ->name('roles.delete')
        ->middleware('permission:manage_roles');

});


Route::middleware(['auth'])->group(function () {

    Route::resource('categories', CategoryController::class)
        ->middleware('permission:add_categories');

});



Route::middleware(['auth'])->group(function () {

    Route::get('/wishlist', function () {
        return view('wishlist');
    })
        ->name('wishlist')
        ->middleware('permission:wishlist');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/my-orders', function () {
        return view('my_orders');
    })
        ->name('my_orders')
        ->middleware('permission:my_orders');


});


Route::post('/cart', [CartController::class, 'store']);

Route::get('/cart/{userId}', [CartController::class, 'index']);

Route::delete('/cart/{id}', [CartController::class, 'destroy']);

Route::put('/inquiries/{id}/status', [InquiryController::class, 'updateStatus'])
    ->name('inquiries.status')->middleware('auth');

Route::post('/inquiries/{id}/reply', [InquiryController::class, 'reply'])
    ->name('inquiries.reply')->middleware('auth');

Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])
    ->name('inquiries.destroy')->middleware('auth');



Route::get('/auto-login/{token}', function ($token) {
    $userId = cache()->pull('auto_login_' . $token);

    if (!$userId) {
        return redirect('/login')->with('error', 'Invalid or expired token');
    }

    $user = \App\Models\User::find($userId);

    if (!$user) {
        return redirect('/login');
    }

    Auth::login($user);

    return redirect('/dashboard');
});




Route::get('/footer-settings', [SettingController::class, 'index'])
    ->name('settings.index');


Route::post(
    '/settings',
    [SettingController::class, 'store']
)->name('settings.store');

Route::get('/invoice/{id}', [OrderController::class, 'downloadInvoice'])
    ->name('invoice');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/manage-pages', [PageController::class, 'managePages'])
        ->name('manage.pages');

    Route::get('/admin/pages/home', [PageController::class, 'home'])
        ->name('pages.home');

    Route::match(
        ['post', 'put'],
        '/admin/home/hero/update',
        [PageController::class, 'updateHero']
    )->name('home.hero.update');
    Route::match(
        ['post', 'put'],
        '/admin/home/badges/update',
        [PageController::class, 'updateBadges']
    )->name('home.badges.update');



    Route::get(
        '/admin/categories/{id}/edit',
        [CategoryController::class, 'edit']
    )->name('categories.edit');

    Route::match(
        ['post', 'put'],
        '/admin/home/categories/update',
        [PageController::class, 'updateCategoriesSection']
    )->name('home.categories.update');
    Route::match(
        ['post', 'put'],
        '/admin/home/flash/update',
        [PageController::class, 'updateFlash']
    )->name('home.flash.update');

    Route::match(
        ['post', 'put'],
        '/admin/home/aipicks/update',
        [PageController::class, 'updateAiPicks']
    )->name('home.aipicks.update');

    Route::match(
        ['post', 'put'],
        '/admin/home/aifeatures/update',
        [PageController::class, 'updateAiFeatures']
    )->name('home.aifeatures.update');

    Route::get(
        '/admin/reviews/{id}/edit',
        [ReviewController::class, 'edit']
    )->name('reviews.edit');

    Route::match(
        ['post', 'put'],
        '/admin/home/reviews/update',
        [PageController::class, 'updateReviews']
    )->name('home.reviews.update');
    Route::match(
        ['post', 'put'],
        '/admin/home/about/update',
        [PageController::class, 'updateAbout']
    )->name('home.about.update');

    Route::match(
        ['post', 'put'],
        '/admin/home/how-it-works/update',
        [PageController::class, 'updateHowItWorks']
    )->name('home.hiw.update');

    Route::match(
        ['post', 'put'],
        '/admin/home/newsletter/update',
        [PageController::class, 'updateNewsletter']
    )->name('home.newsletter.update');



    Route::delete(
        '/admin/categories/{id}',
        [CategoryController::class, 'destroy']
    )->name('categories.destroy');

    Route::delete(
        '/admin/reviews/{id}',
        [ReviewController::class, 'destroy']

    )->name('reviews.destroy');

});


Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('blogs', [BlogController::class, 'adminIndex'])
            ->name('admin.blogs');

        Route::post('blogs', [BlogController::class, 'adminStore'])
            ->name('admin.blogs.store');

        Route::delete('blogs/{id}', [BlogController::class, 'adminDelete'])
            ->name('admin.blogs.delete');

        Route::patch('blogs/{id}/toggle', [BlogController::class, 'adminToggle'])
            ->name('admin.blogs.toggle');

        Route::get('blogs/{id}/edit', [BlogController::class, 'adminEdit'])
            ->name('admin.blogs.edit');

        Route::put('blogs/{id}', [BlogController::class, 'adminUpdate'])
            ->name('admin.blogs.update');
    });


Route::post(
    '/return-request',
    [ReturnController::class, 'store']
);
Route::get('/admin/returns', [ReturnController::class, 'index'])->name('returns.index');
Route::put('/admin/returns/{id}', [ReturnController::class, 'update'])->name('returns.update');


Route::get('/refunds', [RefundController::class, 'index'])->name('refunds.index');
Route::post('/refunds', [RefundController::class, 'create'])->name('refunds.create');
Route::put('/refunds/{id}', [RefundController::class, 'update'])->name('refunds.update');


Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
Route::put('/returns/{id}', [ReturnController::class, 'update'])->name('returns.update');





Route::middleware(['auth'])->group(function () {



    Route::get(
        '/contact-inquiries',
        [InquiryContactController::class, 'index']
    )
        ->name('contact.inquiries')
        ->middleware('permission:view_contact_inquiries');

    Route::post(
        '/contact-inquiries',
        [InquiryContactController::class, 'store']
    )
        ->name('contact.inquiries.store');

    Route::put(
        '/contact-inquiries/{id}/status',
        [InquiryContactController::class, 'updateStatus']
    );

    Route::post('/contact-inquiries/{id}/reply', [InquiryContactController::class, 'reply']);

    Route::delete(
        '/contact-inquiries/{id}',
        [InquiryContactController::class, 'destroy']
    );

});











 
Route::get('/admin/pages/about', [AboutPageController::class, 'manage'])
    ->name('pages.about');
 

 
Route::match(['post', 'put'], '/admin/about/hero/update',
    [AboutPageController::class, 'updateHero'])->name('about.hero.update');
 
Route::match(['post', 'put'], '/admin/about/stats/update',
    [AboutPageController::class, 'updateStats'])->name('about.stats.update');
 
Route::match(['post', 'put'], '/admin/about/story/update',
    [AboutPageController::class, 'updateStory'])->name('about.story.update');
 
Route::match(['post', 'put'], '/admin/about/values/update',
    [AboutPageController::class, 'updateValues'])->name('about.values.update');
 
Route::match(['post', 'put'], '/admin/about/timeline/update',
    [AboutPageController::class, 'updateTimeline'])->name('about.timeline.update');
 
Route::match(['post', 'put'], '/admin/about/team/update',
    [AboutPageController::class, 'updateTeam'])->name('about.team.update');
 
Route::match(['post', 'put'], '/admin/about/awards/update',
    [AboutPageController::class, 'updateAwards'])->name('about.awards.update');
 
Route::match(['post', 'put'], '/admin/about/cta/update',
    [AboutPageController::class, 'updateCta'])->name('about.cta.update');
 













require __DIR__ . '/auth.php';