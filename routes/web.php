<?php

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

Route::prefix('api')->group(function () {

    Route::post('enrollments', ['uses' => 'EnrollmentsController@store'])->name('enrollments.store');

    Route::delete('enrollments/{enrollment}', ['uses' => 'EnrollmentsController@destroy'])->name('enrollments.destroy');

    Route::resource('students','StudentsController', ['only' => ['index','update','destroy','store']]);

    Route::resource('subjects','SubjectsController', ['only' => ['index','update','destroy','store']]);

    Route::get('validation', ['uses' => 'ValidationController'])->name('validation');
});

Route::get('{any?}', function ($any = null) {
    return view('welcome');
})->where('any', '.*');

