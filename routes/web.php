<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('public.index');
})->name('home');

Route::get('/profile', function () {
    return view('public.profile');
})->name('profile');

Route::get('/order_history', function () {
    return view('public.order_history');
})->name('profile.order_history');

Route::get('/view_history', function () {
    return view('public.view_history');
})->name('profile.view_history');

Route::get('/admin', function () {
    return view('cms.index');
})->name('admin');

Route::get('/admin/settings', function () {
    return view('cms.settings.index');
})->name('admin.settings');

Route::get('/admin/hotels', function () {
    return view('cms.hotels.index');
})->name('admin.hotels');

Route::get('/admin/rooms', function () {
    return view('cms.rooms.index');
})->name('admin.rooms');

Route::get('/admin/orders', function () {
    return view('cms.orders.index');
})->name('admin.orders');

Route::get('/admin/feedbacks', function () {
    return view('cms.feedbacks.index');
})->name('admin.feedbacks');
