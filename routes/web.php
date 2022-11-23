<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\TaskController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/language/{lang}', [LangController::class, 'setLanguage'])->name('setLanguage');

Route::middleware(['auth'])->group(function (){
    Route::resource('tasks', TaskController::class)->only(['index']);
    Route::resource('tasks', TaskController::class)->except(['index']);
});

Route::middleware(['auth','isAdmin'])->group(function (){
    Route::post('/tasks/search',[TaskController::class, 'search'])->name('tasks.search');
    Route::get('/tasks/search/reset',[TaskController::class, 'reset'])->name('tasks.search.reset');
    Route::post('/tasks/filter', [TaskController::class, 'filter'])->name('task.filter');
    Route::resource('priorities', PriorityController::class);
});


