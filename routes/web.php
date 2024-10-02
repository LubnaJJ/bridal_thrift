<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AnalyticsController;

// Welcome route
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Middleware for authenticated users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Business Management Routes
Route::get('/admin/businesses', [BusinessController::class, 'index'])->name('admin.businesses.index');

// Customer Management Routes
Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers.index'); // List customers

// Analytics route
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// Manage businesses
Route::get('/manage-businesses', [BusinessController::class, 'index'])->name('manage.businesses');

Route::post('/add-customer', [CustomerController::class, 'store'])->name('add.customer.store');

Route::post('/business/store', [BusinessController::class, 'store'])->name('business.store');

Route::delete('/businesses/delete/{id}', [BusinessController::class, 'destroy'])->name('businesses.delete');

// Customer Management Routes
Route::delete('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.delete');

// Edit customer form
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

// Update customer
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');

Route::post('/customers/update/{id}', [CustomerController::class, 'update'])->name('update.customer');
Route::post('/customers/add', [CustomerController::class, 'store'])->name('add.customer.store'); // For adding new customers
