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

/*Routes for main views of regivit*/
Route::get('/', 'Auth\LoginController@showLoginForm')->name('show_login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('raiz', 'RedirectMenu@master_index')->name('master_index')->middleware('master');
Route::get('coordinator_user', 'RedirectMenu@coordinator_index')->name('coordinator_index')->middleware('coordinator');
Route::get('candidate', 'RedirectMenu@candidate_index')->name('candidate_index')->middleware('candidate_or_teacher');

/*Route resource for controller and methods of regivit*/
/*Resources Controller for Master User | Root*/
Route::middleware(['master'])->group(function () {
    Route::resource('master_user', 'MasterUserController')->only(['index', 'store', 'show', 'edit']);
    Route::post('change_status', 'MasterUserController@changeStatus')->name('change_status');
    Route::post('edit_user', 'MasterUserController@editUser')->name('edit_user');
    /*Resources Controller for Campus*/
    Route::resource('campus', 'CampusController')->only(['index', 'store', 'show', 'edit']);
    Route::post('change_status_campus', 'CampusController@changeStatus')->name('change_status_campus');
    Route::post('edit_campus', 'CampusController@editCampus')->name('edit_campus');
    /*Resources Controller for Faculty*/
    Route::resource('faculty', 'FacultyController')->only(['index', 'store', 'show', 'edit']);
    Route::post('change_status_faculty', 'FacultyController@changeStatus')->name('change_status_faculty');
    Route::post('edit_faculty', 'FacultyController@editCampus')->name('edit_faculty');
    /*Resources Controller for Parish*/
    Route::resource('parish', 'ParishController')->only(['index', 'store', 'show', 'edit']);
    Route::post('edit_parish', 'ParishController@editParish')->name('edit_parish');
    /*Resources for Priest*/
    Route::resource('priest', 'PriestController')->only(['index', 'store', 'show', 'edit']);
    Route::post('edit_priest', 'PriestController@editPriest')->name('edit_priest');
});

/*Routes for cordinator*/
Route::middleware(['coordinator'])->group(function (){
    Route::resource('candidate_user', 'CandidaterUserController')->only(['index', 'store', 'show', 'edit']);
    Route::post('change_status_candidate', 'CandidaterUserController@changeStatus')->name('change_status_candidate');
    Route::post('edit_user_candidate', 'CandidaterUserController@editUser')->name('edit_user_candidate');
    /*Route's teacher*/
    Route::resource('teacher_user', 'TeacherUserController')->only(['index', 'store', 'show', 'edit']);
    Route::post('change_status_teacher', 'TeacherUserController@changeStatus')->name('change_status_teacher');
    Route::post('edit_user_teacher', 'TeacherUserController@editUser')->name('edit_user_teacher');
    Route::resource('documents', 'UpDocumentController')->only(['index', 'store']);
    Route::post('create_document', 'UploadedController@uploadDocuments')->name('create_document');
    /*Routes to asign documents to candidate or teacher*/
    Route::resource('document_date', 'DocumentDateController')->only(['index', 'edit', 'store']);
    Route::get('report/{user_id}/edit', 'ReportController@showReport')->name('report');
    Route::get('general_report', 'ReportController@showGeneralReport')->name('general_report');
    Route::get('/preview/{path}', 'ReportController@previewContent')->name('preview');
    /*Route's to upload date to upload documents*/
});

Route::middleware(['candidate_or_teacher'])->group(function () {
    Route::resource('job_form', 'JobFormController')->only('index', 'store')->middleware('validate_job_form');
    Route::post('screen_save_job_form', 'ScreenController@saveJobForm')->name('screen_save');
    Route::post('screen_save_personal_data', 'ScreenFormController@savePersonalData')->name('screen_save_personal');
    Route::get('screen_save_job_application', 'ScreenController@validateIfExit')->name('check_if_exit_job_form');
    Route::get('screen_save_personal_data_form', 'ScreenFormController@validateIfExit')->name('check_if_exit_personal_data_form');
    Route::resource('personal_data_form', 'PersonalDataFormController')->only(['index', 'store'])->middleware(['validate_personal', 'validate_personal_form']);
    Route::resource('tab_one', 'TabOneController')->only(['index', 'store', 'edit'])->middleware('tab_one');;
    Route::resource('tab_two', 'TabTwoController')->only(['index', 'store', 'edit'])->middleware('tab_two');;
    Route::resource('view_job_form', 'ViewJobFormController')->only(['index', 'store']);
    Route::resource('view_personal', 'ViewPersonalController')->only(['index', 'store']);
    Route::get('error_personal', 'ViewPersonalController@error')->name('error_personal');
    Route::get('tab_one_disabled', 'TabDisabledController@index_tab_one')->name('tab_one_disabled');
    Route::get('tab_two_disabled', 'TabDisabledController@index_tab_two')->name('tab_two_disabled');
    Route::post('save_file', 'SaveFileController@saveFile')->name('save_file');
    Route::get('/preview/{path}', 'ReportController@previewContent')->name('download_form');
});




