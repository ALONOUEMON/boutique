<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard utilisateur
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profil utilisateur
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Administration
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard administrateur
        |--------------------------------------------------------------------------
        */

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Gestion des catégories
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class);


        /*
        |--------------------------------------------------------------------------
        | Gestion des produits
        |--------------------------------------------------------------------------
        */

        Route::resource('products', ProductController::class);


        /*
        |--------------------------------------------------------------------------
        | Gestion des utilisateurs
        |--------------------------------------------------------------------------
        */

        Route::resource('users', UserController::class);


        /*
        |--------------------------------------------------------------------------
        | Gestion des commandes
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [OrderAdminController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/create', [OrderAdminController::class, 'create'])
            ->name('orders.create');

        Route::post('/orders', [OrderAdminController::class, 'store'])
            ->name('orders.store');

        Route::get('/orders/{order}', [OrderAdminController::class, 'show'])
            ->name('orders.show');

        Route::post('/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])
            ->name('orders.updateStatus');

        Route::delete('/orders/{order}', [OrderAdminController::class, 'destroy'])
            ->name('orders.destroy');
    });


/*
|--------------------------------------------------------------------------
| Panier
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update/{product}', [CartController::class, 'update'])
    ->name('cart.update');

Route::post('/cart/remove/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');


/*
|--------------------------------------------------------------------------
| Commandes utilisateur
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/order/create', [OrderController::class, 'create'])
        ->name('order.create');

    Route::post('/order/store', [OrderController::class, 'store'])
        ->name('order.store');

    Route::get('/order/success/{order}', [OrderController::class, 'success'])
        ->name('order.success');

    Route::get('/orders/history', [OrderController::class, 'history'])
        ->name('order.history');
});


/*
|--------------------------------------------------------------------------
| Authentification Laravel
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';