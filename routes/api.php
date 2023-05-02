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
        ]
    ]);

    Route::resource('writers', WriterController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('publishers', PublisherController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('translators', TranslatorController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('magazines', MagazineController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

    Route::resource('special_issues', SpecialIssueController::class, [
        'except' => [
            'create',
            'edit'
        ]
    ]);

});
