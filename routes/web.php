<?php

use App\Models\Company;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
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
$students = User::whereHas(
    'roles', function($q){
        $q->where('name', 'Teacher');
    }
)->get();
*/




Auth::routes();



Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('companies', App\Http\Controllers\CompanyController::class)->middleware('auth');

Route::resource('projects', App\Http\Controllers\ProjectController::class)->middleware('auth');

Route::resource('userStories', App\Http\Controllers\UserStoryController::class)->middleware('auth');

Route::resource('tickets', App\Http\Controllers\TicketController::class)->middleware('auth');
