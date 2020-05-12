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

// Default required by Laravel Auth
Route::get('/login', 'UserController@login')->name('login');
// Login Page
Route::get('/', 'UserController@login')->name('users.login');
// Process Login Page
Route::post('/auth', 'UserController@auth')->name('users.auth');

Route::resource('activities', 'ActivityController');

// Authenticated Users only
Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/dashboard', 'UserController@dashboard')->name('users.dashboard');
    // Logout
    Route::get('logout', 'UserController@logout')->name('users.logout');

    Route::group(['middleware' => ['admin']], function () {
        // Users
        Route::get('/users', 'UserController@index')->name('users.index');
        // Store Users
        Route::post('/users', 'UserController@store')->name('users.store');
        // Edit Users
        Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
        // Delete Users
        Route::post('/users/destroy/{id}', 'UserController@destroy')->name('users.delete');
        // Update
        Route::post('/users/update', 'UserController@update')->name('users.update');

        // Categories
        Route::get('/categories', 'CategoryController@index')->name('categories.index');
        // Save Categories
        Route::post('/categories', 'CategoryController@store')->name('categories.store');
        // Edit Categories
        Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
        // Delete Users
        Route::post('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.delete');
        // Change Category Status
        Route::post('/categories/{id}/change-status', 'CategoryController@changestatus')->name('categories.change.status');
        // Update Categories
        Route::post('/categories/update', 'CategoryController@update')->name('categories.update');

    });

    // Change Password
    Route::post('/users/password', 'UserController@password')->name('users.password');


    // Todos
    Route::get('/todos', 'TodoController@index')->name('todos.index');
    // Store Todo
    Route::post('/todos', 'TodoController@store')->name('todos.store');
    // Edit Todo
    Route::get('/todos/{id}/edit', 'TodoController@edit')->name('todos.edit');
    // View Todo
    Route::get('/todos/{id}/show', 'TodoController@view')->name('todos.view');
    // Delete Todo
    Route::post('/todos/{id}/destroy', 'TodoController@destroy')->name('todos.delete');
    // Complete Todo
    Route::post('/todos/{id}/complete', 'TodoController@complete')->name('todos.complete');
    // Update Todo
    Route::post('todos/update', 'TodoController@update')->name('todos.update');
});


