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

Auth::routes(['verify' => true]);

Route::view('/', 'frontview.index')->name('home');
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
Route::view('/global-e-learning', 'frontview.global-e-learning');
Route::view('/e-learning-hub', 'frontview.e-learninghub');
Route::view('/tesda-online', 'frontview.tesda-online');

Route::post('/sendInquiry', 'InquiryController@sendInquiry')->name('send.inquiry');

Route::prefix('client')->group(function () {
    Route::get('/application-form', 'ClientController@showApplicationForm')->name('cl.application')->middleware(['verified', 'auth']);
    Route::post('/sendApplication', 'ClientController@sendApplication')->middleware(['verified', 'auth']);

    Route::get('/dashboard', 'ClientController@showDashboard')->name('cl.dashboard')->middleware(['verified', 'auth']);
});


Route::prefix('sa')->group(function () {
    Route::get('/dashboard', 'SuperadminController@showDashboard')->name('sa.dashboard')->middleware('auth');

    Route::get('/clients', 'SuperadminController@showClients')->name('sa.clients');
    Route::get('/client/{id}', 'SuperadminController@showSelectedClient')->name('sa.selected.client');

    // Route::get('/programs', 'SuperadminController@showPrograms')->name('sa.programs');
    Route::get('/programs', 'ProgramController@showProgramEntry')->name('sa.programs');

    Route::get('/moderators', 'ModeratorController@showModeratorEntry')->name('sa.moderators');
    Route::get('/moderators/create', 'ModeratorController@createModerator')->name('sa.moderators.create');

    Route::get('/program/initials/{programId}', 'InitialController@showInitialRequirements')->name('sa.program.initials');

    Route::get('/logs', 'LogController@showLogs')->name('sa.logs');
});

Route::prefix('md')->group(function () {
    Route::get('/dashboard', 'ModeratorController@showDashboard')->name('md.dashboard')->middleware('auth');

    Route::get('/clients', 'ModeratorController@showClients')->name('md.clients')->middleware('auth');
    Route::get('/client/{id}', 'ModeratorController@showSelectedClient')->name('md.selected.client')->middleware('auth');
});

Route::get('/getAllPrograms', 'ProgramController@getAllPrograms');
Route::post('/storeProgramDetails', 'ProgramController@storeProgramDetails');
Route::patch('/updateProgramDetails/{id}', 'ProgramController@updateProgramDetails');
Route::delete('/deleteProgramDetails/{id}', 'ProgramController@deleteProgramDetails');

Route::get('/getAllInitialRequirements/{programId}', 'InitialController@getAllInitialRequirements');
Route::get('/getInitialRequirementsForClient', 'InitialController@getInitialRequirementsForClient');
Route::post('/storeInitialRequirement/{programId}', 'InitialController@storeInitialRequirement');
Route::put('/updateInitialRequirement', 'InitialController@updateInitialRequirement');
Route::delete('/deleteInitialRequirement/{id}', 'InitialController@deleteInitialRequirement');

Route::get('/getLoggedClientDetails', 'ClientController@getLoggedClientDetails');
Route::get('/getAllClientDetails', 'ClientController@getAllClients');
Route::post('/setApplicationStatus/{id}', 'ClientController@setApplicationStatus');
Route::delete('/deleteClientDetails/{userId}', 'ClientController@deleteClientDetails');
Route::post('/updateClientDetails', 'ClientController@updateClientDetails');

Route::get('/getInitialRequirementsWithClient', 'ClientInitialController@getClientInitialRequirements');
Route::post('/storeClientInitialRequirements', 'ClientInitialController@storeClientInitialRequirement');
Route::delete('/deleteClientInitialRequirement/{id}', 'ClientInitialController@deleteClientInitialRequirement');

Route::get('/moderators/all', 'ModeratorController@getAllModerators');
Route::post('/moderators/store', 'ModeratorController@storeModerator');
Route::get('/moderators/edit/{userId}', 'ModeratorController@editModerator');
Route::put('/moderators/update', 'ModeratorController@updateModerators');
Route::delete('/moderators/delete/{userId}', 'ModeratorController@deleteModerator');

Route::delete('/logs/delete/{id}', 'LogController@deleteLog');
