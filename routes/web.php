<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
/*use Illuminate\Support\Facades\Route;*/

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
    return redirect('login');
});


Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');


Route::group(['middleware' => 'auth'], function()
{

    Route::resource('projects', ProjectController::class)
        ->middleware('auth');

    Route::resource('tasks', TaskController::class)
        ->middleware('auth');

    Route::get('change-status', [App\Http\Controllers\TaskController::class, 'changeStatus'])
        ->name('change.status');

    Route::get('download-file/{id}', [App\Http\Controllers\FileController::class, 'download'])
        ->name('download.file');

    Route::get('delete-file/{id}', [App\Http\Controllers\FileController::class, 'destroy'])
        ->name('delete.file');
});
