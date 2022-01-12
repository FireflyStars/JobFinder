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



Route::get('/', 'HomeController@index');
Route::get('/contact-us', 'HomeController@contact');
Route::post('/contact-us', 'HomeController@saveContact');

Route::get('/post-a-job', 'JobController@create')->name('post-a-job');
Route::get('/post-a-job/{id}', 'JobController@create');
Route::get('/preview-job/{id}', 'JobController@preview');
Route::get('/make-payment/{id}', 'JobController@payment');
Route::post('/post-a-job', 'JobController@store');
Route::post('/payment-done', 'JobController@paymentDone');
Route::get('/search-job', 'JobController@searchJobs');

Route::get('/search-jobsdfdsfs', function(){
    return 'sdfsdfdsf';
});


Route::get('/job-detail/{id}', 'JobController@detail');
Route::get('/load-job-detail/{id}', 'JobController@loadJobDetail');

Route::get('/admin/login', 'AuthController@index')->name('admin.login');
Route::post('admin/login', 'AuthController@authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('admin/logout', 'AuthController@logout');
    Route::get('admin/dashboard', 'DashboardController@index');
    Route::resource('admin/category', 'CategoryController')->except(['show']);
    Route::resource('admin/job', 'AdminJobController')->except(['show']);
    Route::get('admin/load-jobs', 'AdminJobController@loadJobs')->name("admin.load-jobs");
    Route::post('admin/make-premium', 'AdminJobController@makePremium');
    Route::post('admin/remove-premium', 'AdminJobController@removePremium');
});