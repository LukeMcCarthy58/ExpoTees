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

Route::get('/', 'PagesController@index');

Route::resource('posts', 'ProjectsController');
Route::resource('supervisorprojects', 'SupervisorController');
Route::resource('adminprojects', 'AdminController');
Route::get('/dashboard', 'DashboardController@index');

Route::resource('assign', 'AssignsController');
Auth::routes();