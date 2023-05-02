<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\MagazineController;
use App\Http\Controllers\API\PublisherController;
use App\Http\Controllers\API\SpecialIssueController;
use App\Http\Controllers\API\TranslatorController;
use App\Http\Controllers\API\WriterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('v1')->group(function () {

    Route::resource('books', BookController::class, [
        'except' => [
            'create',
            'edit'
        ],
        'names' => array(
            'index' => 'api.books.index',
            'store' => 'api.books.store',
            'show' => 'api.books.show',
            'update' => 'api.books.update',
            'destroy' => 'api.books.destroy',
        )
    ]);

    Route::resource('writers', WriterController::class, [
        'except' => [
            'create',
            'edit'
        ],
        'names' => array(
            'index' => 'api.writers.index',
            'store' => 'api.writers.store',
            'show' => 'api.writers.show',
            'update' => 'api.writers.update',
            'destroy' => 'api.writers.destroy',
        )
    ]);

    Route::resource('publishers', PublisherController::class, [
        'except' => [
            'create',
            'edit'
        ],
        'names' => array(
            'index' => 'api.publishers.index',
            'store' => 'api.publishers.store',
            'show' => 'api.publishers.show',
            'update' => 'api.publishers.update',
            'destroy' => 'api.publishers.destroy',
        )
    ]);

    Route::resource('translators', TranslatorController::class, [
        'except' => [
            'create',
            'edit'
        ],
        'names' => array(
            'index' => 'api.translators.index',
            'store' => 'api.translators.store',
            'show' => 'api.translators.show',
            'update' => 'api.translators.update',
            'destroy' => 'api.translators.destroy',
        )
    ]);

    Route::resource('magazines', MagazineController::class, [
        'except' => [
            'create',
            'edit'
        ],
        'names' => array(
            'index' => 'api.magazines.index',
            'store' => 'api.magazines.store',
            'show' => 'api.magazines.show',
            'update' => 'api.magazines.update',
            'destroy' => 'api.magazines.destroy',
        )
    ]);

    Route::resource('special_issues', SpecialIssueController::class, [
        'except' => [
            'create',
            'edit'
        ],
        'names' => array(
            'index' => 'api.special_issues.index',
            'store' => 'api.special_issues.store',
            'show' => 'api.special_issues.show',
            'update' => 'api.special_issues.update',
            'destroy' => 'api.special_issues.destroy',
        )
    ]);

});
