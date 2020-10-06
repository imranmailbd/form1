<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'authenticationValidateAdmin'])->name('admin.route')->middleware('authentic');


Route::get('/', [App\Http\Controllers\ApplicantController::class, 'index'])->name('reg_form');
Route::post('/applicant', [App\Http\Controllers\ApplicantController::class, 'store']);

Route::get('divisions/{id}',[App\Http\Controllers\ApplicantController::class, 'getDistrict'])->name('districts');
Route::get('districts/{id}',[App\Http\Controllers\ApplicantController::class, 'getUpazila'])->name('upazilas');

Route::get('admin/divisions_search/{id}',[App\Http\Controllers\ApplicantMngController::class, 'getDistrict'])->name('districts_search');
Route::get('admin/districts_search/{id}',[App\Http\Controllers\ApplicantMngController::class, 'getUpazila'])->name('upazilas_search');


Route::get('admin/applicant_manage', [App\Http\Controllers\ApplicantMngController::class, 'index'])->name('users.index')->middleware('auth');


