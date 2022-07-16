<?php

use App\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
Route::get('/blog', 'BlogController@showBlogList');
Route::get('/blog/{slug}', 'BlogController@showSelectedBlog');

Route::post('/sendInquiry', 'InquiryController@sendInquiry')->name('send.inquiry');

Route::prefix('cert')->group(function () {
    Route::get('/search', 'CertificateController@showSearchCertificate');
    Route::get('/{certId}', 'CertificateController@showCertificate');
});

Route::prefix('staff')->group(function () {
    Route::get('/registration', 'StaffController@showRegistration')->name('s.registration');
    Route::post('/register', 'StaffController@register')->name('s.register');
    Route::get('/dashboard', 'StaffController@showDashboard')->name('s.dashboard')->middleware(['verified']);
});

Route::prefix('client')->middleware('is_client')->group(function () {
    Route::get('/application-form', 'ClientController@showApplicationForm')->name('cl.application')->middleware(['verified', 'auth']);
    Route::post('/basic-validation', 'RegistrationValidationController@basicDetailsValidation')->middleware(['verified', 'auth']);
    Route::post('/sendApplication', 'ClientController@sendApplication')->middleware(['verified','auth']);

    Route::get('/dashboard', 'ClientController@showDashboard')->name('cl.dashboard')->middleware(['verified', 'auth']);
    Route::get('/{programId}/requirements', 'ClientController@showClientRequirements');
});

Route::prefix('ac')->middleware('is_accounting')->group(function() {
    Route::get('/clients', 'AccountingController@showAccountingClients')->name('ac.clients')->middleware('auth');
    Route::get('/client/{id}', 'AccountingController@showAccountingSelectedClient')->name('ac.client');
    Route::post('/verifyPayment', 'AccountingController@paymentVerified')->name('ac.verify');
    Route::get('/dashboard', 'AccountingController@showAccountingDashboard')->name('ac.dashboard');

    Route::post('/searchStudentByLastName', 'AccountingController@searchStudentByLastName');
});

Route::prefix('sa')->middleware('is_superadmin')->group(function () {
    Route::get('/dashboard', 'SuperadminController@showDashboard')->name('sa.dashboard')->middleware('auth');

    Route::get('/clients', 'SuperadminController@showClients')->name('sa.clients');
    Route::get('/client/{id}', 'SuperadminController@showSelectedClient')->name('sa.selected.client');

    // Route::get('/programs', 'SuperadminController@showPrograms')->name('sa.programs');
    Route::get('/programs', 'ProgramController@showProgramEntry')->name('sa.programs');

    Route::get('/moderators', 'ModeratorController@showModeratorEntry')->name('sa.moderators');
    Route::get('/moderators/create', 'ModeratorController@createModerator')->name('sa.moderators.create');

    Route::get('/program/initials/{programId}', 'InitialRequirementController@showInitialRequirements')->name('sa.program.initials');

    Route::get('/logs', 'LogController@showLogs')->name('sa.logs');

    Route::get('/teachers', 'TeacherController@showTeacherEntry')->name('sa.teachers');

    Route::get('/{programId}/lessons', 'LessonController@showLessonEntry')->name('sa.program.lessons');

    Route::get('/client/{userId}/program/{programId}', 'SuperadminController@showSelectedProgram')->name('sa.selected.program');

    Route::get('/school', 'SchoolController@showSchoolEntry');
    
    Route::get('/certs', 'CertificateController@showCertificateEntry');

    Route::get('/staffs', 'SuperadminController@showStaffEntry');

    Route::get('/blogs', 'BlogController@showBlogEntry');
    Route::get('/blogs/create', 'BlogController@showBlogCreate');
});

Route::prefix('md')->middleware('is_moderator')->group(function () {
    Route::get('/dashboard', 'ModeratorController@showDashboard')->name('md.dashboard')->middleware('auth');
    Route::get('/certs', 'ModeratorController@showLobsterGrades')->name('md.certs')->middleware('auth');

    Route::get('/clients', 'ModeratorController@showClients')->name('md.clients')->middleware('auth');
    Route::get('/client/{userId}', 'ModeratorController@showSelectedClient')->name('md.selected.client')->middleware('auth');
    Route::get('/client/{userId}/program/{programId}', 'ModeratorController@showSelectedProgram')->name('md.selected.program');
});

Route::prefix('teacher')->group(function () {
    Route::get('/dashboard', 'TeacherController@showTeacherDashboard')->name('tc.dashboard');
    Route::get('/students', 'TeacherController@showStudents')->name('teacher.students');
    Route::get('/{programId}/gradebook', 'TeacherController@showGradebook')->name('teacher.gradebook');
    Route::get('/stud-profile/{userId}', 'TeacherController@showStudentProfile')->name('teacher.stud-profile');
    Route::get('/student/{userId}/gradebook/{programId}', 'TeacherController@showStudentGradebook');
});

Route::post('/publishBlog', 'BlogController@publishBlog');
Route::get('/blogEdit/{blogId}', 'BlogController@editBlog');
Route::patch('/blogUpdate', 'BlogController@updateBlog');
Route::delete('/blogDelete/{blogId}', 'BlogController@deleteBlog');
Route::post('/blogImageUpload', 'MediaController@blogImageUpload');

Route::get('/getAllPrograms', 'ProgramController@getAllPrograms');
Route::post('/storeProgramDetails', 'ProgramController@storeProgramDetails');
Route::patch('/updateProgramDetails/{id}', 'ProgramController@updateProgramDetails');
Route::delete('/deleteProgramDetails/{id}', 'ProgramController@deleteProgramDetails');
Route::post('/activateProgram/{id}', 'ProgramController@activateProgram');
Route::post('/deactivateProgram/{id}', 'ProgramController@deactivateProgram');

Route::get('/getInitial', 'InitialRequirementController@getInitial');
Route::get('/getAllInitialRequirements/{programId}', 'InitialRequirementController@getAllInitialRequirements');
Route::post('/storeInitialRequirement/{programId}', 'InitialRequirementController@storeInitialRequirement');
Route::put('/updateInitialRequirement', 'InitialRequirementController@updateInitialRequirement');
Route::delete('/deleteInitialRequirement/{id}', 'InitialRequirementController@deleteInitialRequirement');

Route::get('/getLoggedClientDetails', 'ClientController@getLoggedClientDetails');
Route::get('/getAllClientDetails', 'ClientController@getAllClientDetails');
Route::post('/setApplicationStatus/{id}', 'UserProgramController@setApplicationStatus');
Route::delete('/deleteClientDetails/{userId}', 'ClientController@deleteClientDetails');
Route::post('/updateClientDetails', 'ClientController@updateClientDetails');
Route::post('/setToVerified/{userId}', 'ClientController@manualVerification');
Route::post('/setToUnfilled/{userId}', 'ClientController@setToUnfilled');
Route::post('/setToFilled/{userId}', 'ClientController@setToFilled');

Route::get('/getInitialRequirementsWithClient', 'ClientInitialController@getClientInitialRequirements');
Route::post('/storeClientInitialRequirements', 'ClientInitialController@storeClientInitialRequirement');
Route::delete('/deleteClientInitialRequirement/{id}', 'ClientInitialController@deleteClientInitialRequirement');

Route::post('/storeTeacher', 'TeacherController@storeTeacher');
Route::put('/updateTeacher', 'TeacherController@updateTeacher');
Route::delete('/deleteTeacher/{userId}', 'TeacherController@deleteTeacher');

Route::post('/storeGrade', 'GradeController@storeGrade');
Route::get('/getClientGrades/{programId}', 'GradeController@getClientGrades');
Route::delete('/deleteGrade/{gradeId}', 'GradeController@deleteGrade');

Route::get('/moderators/all', 'ModeratorController@getAllModerators');
Route::post('/moderators/store', 'ModeratorController@storeModerator');
Route::get('/moderators/edit/{userId}', 'ModeratorController@editModerator');
Route::put('/moderators/update', 'ModeratorController@updateModerators');
Route::delete('/moderators/delete/{userId}', 'ModeratorController@deleteModerator');

Route::post('/searchStudentByLastName', 'ModeratorController@searchStudentByLastName');

Route::post('/storeLesson', 'LessonController@storeLesson');
Route::put('/updateLesson/{lessonId}', 'LessonController@updateLesson');
Route::delete('/deleteLesson/{lesson}', 'LessonController@deleteLesson');
Route::delete('/logs/delete/{id}', 'LogController@deleteLog');

Route::post('/addDepositSlip', 'PaymentController@addDepositSlip');
Route::post('/payBySchool', 'PaymentController@payBySchool');
Route::delete('/removeDepositSlip/{slipId}', 'PaymentController@removeDepositSlip');

Route::get('/getUserPrograms', 'UserProgramController@getUserProgram');
Route::post('/addClientUserProgram', 'UserProgramController@superadminAddNewProgram');
Route::post('/addNewProgram', 'UserProgramController@addNewProgram');
Route::put('/updateUserProgram', 'UserProgramController@updateUserProgram');
Route::delete('/deleteUserProgram/{id}', 'UserProgramController@deleteUserProgram');

Route::post('/storeSchool', 'SchoolController@storeSchool');
Route::put('/updateSchool', 'SchoolController@updateSchool');
Route::delete('/deleteSchool/{id}', 'SchoolController@deleteSchool');

Route::post('/searchLobsterInkCertificate', 'CertificateController@getSearchedLobsterInkCert');
Route::post('/uploadCertificate', 'CertificateController@uploadCertificates');
Route::post('/addCertificate', 'CertificateController@addCertificate');
Route::patch('/updateCertificate', 'CertificateController@updateCertificate');
Route::delete('/deleteCertificate/{id}', 'CertificateController@deleteCert');  

Route::post('/activateStaff/{userId}', 'StaffController@activateStaff');
Route::delete('/removeStaff/{userid}', 'StaffController@removeStaff');

Route::post('/searchClientByEmail', 'SuperadminController@searchClientByEmail');

Route::get('/certList', 'CertificateEditorController@certList');
Route::get('/certEditorView/{layoutId}', 'CertificateEditorController@viewEditor');
Route::get('/certActual/{layoutId}', 'CertificateEditorController@viewActual');
Route::post('/certChange', 'CertificateEditorController@saveChanges');
Route::post('/addCertTemplate', 'CertificateEditorController@addCertTemplate');

/** E-CERTS Routes */
Route::get('/certClients', 'CertificateClientController@clientList');
Route::get('/certClientActual/{userId}', 'CertificateClientController@viewClientActualCert');
Route::get('/certDownload', 'CertificateClientController@viewSearchToDownloadCert')->withoutMiddleware('auth');
Route::get('/viewCertDownloadingPage', 'CertificateClientController@viewCertDownloadingPage')->withoutMiddleware('auth');
Route::get('/certDownloadActual/{userId}', 'CertificateClientController@downloadClientActualCert');
Route::post('/getSearchedCertificate', 'CertificateClientController@getSearchedCertificate');
Route::post('/certClientsAddBulk', 'CertificateClientController@saveBulkClients');
Route::delete('/certDelete/{certId}', 'CertificateClientController@deleteClientCert');
Route::post('/searchCertificate', 'CertificateClientController@searchCertificate');
Route::post('/certSaveSingle', 'CertificateClientController@saveSingleClient');
Route::patch('/certUpdateClient', 'CertificateClientController@updateClientCert');

Route::get('/lobsterCertLayouts', 'LobsterLayoutGeneratorController@showLobsterLayouts');
Route::post('/lobsterCertLayoutStore', 'LobsterLayoutGeneratorController@addNewLobsterLayout');
Route::get('/lobsterCertLayoutView/{layoutId}', 'LobsterLayoutGeneratorController@viewSelectedLobsterLayout');
Route::patch('/lobsterCertLayoutUpdate', 'LobsterLayoutGeneratorController@updateLobsterLayout');
Route::delete('/lobsterCertLayoutDelete/{layoutid}', 'LobsterLayoutGeneratorController@removeLobsterLayout');
Route::get('/lobsterCertForEditor/{layoutid}', 'LobsterLayoutGeneratorController@viewEditorLobsterLayout');
Route::get('/lobsterCertForActual/{layoutid}', 'LobsterLayoutGeneratorController@viewActualLobsterLayout');

Route::get('/hiapCoCDownload', 'LobsterCertificateClientController@viewSearchToDownloadCert');
Route::post('/getSearchedLobsterCertificate', 'LobsterCertificateClientController@getSearchedLobsterCertificate');
Route::get('/lobsterClientCertDownload/{userId}', 'LobsterCertificateClientController@downloadClientLobsterCertificate');
Route::get('/viewCoCDownloadingPage', 'LobsterCertificateClientController@viewLobsterCertDownloadingPage');
Route::get('/lobsterClientCerts', 'LobsterCertificateClientController@showLobsterClientCertificates');
Route::post('/lobsterClientUploadCerts', 'LobsterCertificateClientController@uploadLobsterClients');
Route::post('/lobsterClientUploadCert', 'LobsterCertificateClientController@uploadLobsterClient');
Route::delete('/lobsterClientDeleteCert/{id}', 'LobsterCertificateClientController@removeLobsterClient');
Route::patch('/lobsterClientUpdateCert/{id}', 'LobsterCertificateClientController@updateLobsterClient');
Route::post('/lobsterClientSearch', 'LobsterCertificateClientController@searchLobsterCertificate');

Route::post('/addStyleToCertificate', 'CertStyleGeneratorController@addStyleToCert');
Route::patch('/updateStyleToCertificate/{styleId}', 'CertStyleGeneratorController@updateStyleToCert');

Route::post('/filterClients', 'ClientController@filterClients');
Route::post('/filterClientsPayment', 'ClientController@filterClientsPayment');
Route::post('/setToDefaultPassword', 'ClientController@setUserPasswordToDefault');

Route::post('/updateUserPassword', 'UserController@updateUserPassword');

Route::get('/testing', function() {
    // return Program::whereIn('id', [1, 2])->get();
});
