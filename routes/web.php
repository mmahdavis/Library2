<?php

use App\Http\Controllers\AudiosController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
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

    Route::get('dashboard/profile', function () {
        return Inertia::render('ProfileView');
    })->name('profile');

    Route::get('dashboard/notification', function () {
        return Inertia::render('NotificationView');
    })->name('notification');

    Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('', 'home')->name('dashboard.home');
        Route::get('profile', 'profile')->name('dashboard.profile');
        Route::get('notification', 'notification')->name('dashboard.notification');
    });

    Route::prefix('dashboard/books')->controller(BookController::class)->group(function () {
        // Get all Books
        Route::get('', 'index')->name('books.index');
        // Create Book Page
        Route::get('/create', 'create')->name('books.create');
        // Get a single Book
        Route::get('/{id}', 'show')->name('books.show');
        // Create a new Book
        Route::post('', 'store')->name('books.store');
        // Update an existing Book
        Route::put('/{book}', 'update')->name('books.update');
        // Delete an Book
        Route::delete('', 'destroy')->name('books.destroy');
    });

    Route::prefix('dashboard/writers')->controller(WriterController::class)->group(function () {
        // Get all writers
        Route::get('', 'index')->name('writers.index');
        // Get a single writer
        Route::get('/{id}', 'show')->name('writers.show');
        // Create a new writer
        Route::post('', 'store')->name('writers.store');
        // Update an existing writer
        Route::put('/{writer}', 'update')->name('writers.update');
        // Delete an writer
        Route::delete('/{writer}', 'destroy')->name('writers.destroy');
    });

    Route::prefix('dashboard/publishers')->controller(PublisherController::class)->group(function () {
        // Get all publishers
        Route::get('', 'index')->name('publishers.index');
        // Get a single publisher
        Route::get('/{id}', 'show')->name('publishers.show');
        // Create a new publisher
        Route::post('', 'store')->name('publishers.store');
        // Update an existing publisher
        Route::put('/{publisher}', 'update')->name('publishers.update');
        // Delete an publisher
        Route::delete('/{publisher}', 'destroy')->name('publishers.destroy');
    });

    Route::prefix('dashboard/translators')->controller(TranslatorController::class)->group(function () {
        // Get all translators
        Route::get('', 'index')->name('translators.index');
        // Get a single translator
        Route::get('/{id}', 'show')->name('translators.show');
        // Create a new translator
        Route::post('', 'store')->name('translators.store');
        // Update an existing translator
        Route::put('/{translator}', 'update')->name('translators.update');
        // Delete an translator
        Route::delete('/{translator}', 'destroy')->name('translators.destroy');
    });

    Route::prefix('dashboard/magazines')->controller(MagazineController::class)->group(function () {
        // Get all magazines
        Route::get('', 'index')->name('magazines.index');
        // Get a single magazine
        Route::get('/{id}', 'show')->name('magazines.show');
        // Create a new magazine
        Route::post('', 'store')->name('magazines.store');
        // Update an existing magazine
        Route::put('/{magazine}', 'update')->name('magazines.update');
        // Delete an magazine
        Route::delete('/{magazine}', 'destroy')->name('magazines.destroy');
    });

    Route::prefix('dashboard/special_issues')->controller(SpecialIssueController::class)->group(function () {
        // Get all special_issues
        Route::get('', 'index')->name('special_issues.index');
        // Get a single special_issue
        Route::get('/{id}', 'show')->name('special_issues.show');
        // Create a new special_issue
        Route::post('', 'store')->name('special_issues.store');
        // Update an existing special_issue
        Route::put('/{special_issue}', 'update')->name('special_issues.update');
        // Delete an special_issue
        Route::delete('/{special_issue}', 'destroy')->name('special_issues.destroy');
    });

    Route::prefix('dashboard/images')->controller(ImagesController::class)->group(function () {
        // Get all images
        Route::get('', 'index')->name('images.index');
        // Get a single image
        Route::get('/{id}', 'show')->name('images.show');
        // Create a new image
        Route::post('', 'store')->name('images.store');
        // Update an existing image
        Route::put('/{image}', 'update')->name('images.update');
        // Delete an image
        Route::delete('/{image}', 'destroy')->name('images.destroy');
    });

    Route::prefix('dashboard/audios')->controller(AudiosController::class)->group(function () {
        // Get all audios
        Route::get('', 'index')->name('audios.index');
        // Get a single audio
        Route::get('/{id}', 'show')->name('audios.show');
        // Create a new audio
        Route::post('', 'store')->name('audios.store');
        // Update an existing audio
        Route::put('/{audio}', 'update')->name('audios.update');
        // Delete an audio
        Route::delete('/{audio}', 'destroy')->name('audios.destroy');
    });
});
