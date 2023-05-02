<?php

use App\Http\Controllers\AudiosController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SpecialIssueController;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\WriterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('HomeView');
    })->name('dashboard');

    Route::resource('dashboard/books', BookController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('dashboard/writers', WriterController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('dashboard/publishers', PublisherController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('dashboard/translators', TranslatorController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('dashboard/magazines', MagazineController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('dashboard/special_issues', SpecialIssueController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);
});
