<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

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
    return view('index', [
        'title' => 'Home Page'
    ]);
});

Route::prefix('students')->group(function () {
    Route::get('/', [StudentsController::class, 'index']);
    Route::get('/add', [StudentsController::class, 'create']);
    Route::get('/{id}/edit', [StudentsController::class, 'edit']);
    Route::post('/store', [StudentsController::class, 'store']);
    Route::put('/{id}', [StudentsController::class, 'update']);
    Route::delete('/{id}', [StudentsController::class, 'destroy']);
});
