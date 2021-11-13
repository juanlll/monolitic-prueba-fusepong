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

//Route::resource('companies', App\Http\Controllers\CompanyController::class)->middleware('auth');

Route::get('companies', App\Http\Controllers\Company\IndexCompanyController::class)->name('companies.index')->middleware('auth');
Route::get('companies/{id}', App\Http\Controllers\Company\ShowCompanyController::class)->name('companies.show')->middleware('auth');
Route::get('companies/{id}/edit', App\Http\Controllers\Company\EditCompanyController::class)->name('companies.edit')->middleware('auth');
Route::get('companies/create', App\Http\Controllers\Company\CreateCompanyController::class)->name('companies.create')->middleware('auth');
Route::put('companies', App\Http\Controllers\Company\UpdateCompanyController::class)->name('companies.update')->middleware('auth');
Route::post('companies', App\Http\Controllers\Company\StoreCompanyController::class)->name('companies.store')->middleware('auth');
Route::delete('companies', App\Http\Controllers\Company\DeleteCompanyController::class)->name('companies.delete')->middleware('auth');

Route::resource('projects', App\Http\Controllers\ProjectController::class)->middleware('auth');

Route::resource('userStories', App\Http\Controllers\UserStoryController::class)->middleware('auth');

Route::resource('tickets', App\Http\Controllers\TicketController::class)->middleware('auth');
