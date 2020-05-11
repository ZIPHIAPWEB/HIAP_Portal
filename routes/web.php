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

Route::view('/', 'frontview.index');
Route::view('/about-us', 'frontview.about-us');
Route::view('/assessment', 'frontview.assessment');
Route::view('/blog', 'frontview.blog');
Route::view('/contact-us', 'frontview.contact-us');
Route::view('/customized-senior-25', 'frontview.customized-senior-25');
Route::view('/customized-college', 'frontview.customized-college');
Route::view('/customized-prof', 'frontview.customized-prof');
Route::view('/customized-senior', 'frontview.customized-senior');
Route::view('/e-learning', 'frontview.e-learning');
Route::view('/enroll-now', 'frontview.enroll-now');
Route::view('/faqs', 'frontview.faqs');
Route::view('/our-services', 'frontview.our-services');
Route::view('/our-facilities', 'frontview.our-facilities');
Route::view('/owwa', 'frontview.owwa');
Route::view('/senior-scholarship', 'frontview.senior-scholarship');
Route::view('/social-stream' , 'frontview.social-stream');
Route::view('/tesda-training', 'frontview.tesda-training');
Route::view('/twsp', 'frontview.twsp');
