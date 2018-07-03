<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::get('/profile', 'SettingController@profile');
Route::post('/update-password', 'SettingController@updatePassword');
Route::post('/update-information', 'SettingController@updateInformation');

Route::post('/update-image-school/{id}', 'SettingController@updateImageSchool');
Route::post('/update-password-school/{id}', 'SettingController@updatePasswordSchool');
Route::post('/update-information-school/{id}', 'SettingController@updateInformationSchool');

Route::post('/update-active-school/{id}', 'SettingController@updateActiveSchool');

Route::post('/update-image-teacher/{id}', 'SettingController@updateImageTeacher');
Route::post('/update-password-teacher/{id}', 'SettingController@updatePasswordTeacher');
Route::post('/update-information-teacher/{id}', 'SettingController@updateInformationTeacher');

Route::post('/update-image-student/{id}', 'SettingController@updateImageStudent');
Route::post('/update-information-student/{id}', 'SettingController@updateInformationStudent');

Route::get('/school', 'SchoolController@index');
Route::get('/school/{id}', 'SchoolController@show');
Route::post('/delete-school/{id}', 'SchoolController@deleteSchool');
Route::get('/get_teacher_school/{id}', 'SchoolController@getTeachers');

Route::get('/teacher', 'TeacherController@index');
Route::get('/teacher/{id}', 'TeacherController@show');
Route::post('/delete-teacher/{id}', 'TeacherController@deleteTeacher');
Route::post('/d-e-teacher/{id}', 'TeacherController@disabledTeacher');
Route::get('/school-teachers/{id}', 'TeacherController@schoolTeachers');


Route::get('/student', 'StudentController@index');
Route::get('/student/{id}', 'StudentController@show');
Route::post('/delete-student/{id}', 'StudentController@deleteStudent');
Route::get('/school-students/{id}', 'StudentController@schoolStudents');
Route::get('/teacher-students/{id}', 'StudentController@teacherStudents');

Route::get('/subject', 'SubjectController@index');

Route::get('/subject/create', 'SubjectController@create');
Route::post('/subject/create', 'SubjectController@store');

Route::get('/subject/{id}', 'SubjectController@show');

Route::post('/delete-subject/{id}', 'SubjectController@destroy');
Route::post('/update-subject/{id}', 'SubjectController@update');

Route::get('/sub-subject', 'SubSubjectController@index');

Route::get('/sub-subject/create', 'SubSubjectController@create');
Route::post('/sub-subject/create', 'SubSubjectController@store');

Route::get('/sub-subject/{id}', 'SubSubjectController@show');

Route::post('/delete-sub-subject/{id}', 'SubSubjectController@destroy');
Route::post('/update-sub-subject/{id}', 'SubSubjectController@update');

Route::post('/update-subjects-student/{id}', 'StudentController@updateSubjectStudent');

Route::get('/standard', 'StandardController@index');

Route::get('/standard/create', 'StandardController@create');
Route::post('/standard/create', 'StandardController@store');

Route::get('/standard/{id}', 'StandardController@show');

Route::post('/delete-standard/{id}', 'StandardController@destroy');
Route::post('/update-standard/{id}', 'StandardController@update');

Route::get('/sub-subject-standards/{id}', 'StandardController@subjectStandards');

/*Route::get('/pricing', 'SettingController@pricing');
Route::get('/billingBills', 'BillingBillsController@index');
Route::get('/billingBills/{id}', 'BillingBillsController@show');

Route::post('/delete-billingBill/{id}', 'BillingBillsController@destroy');
Route::post('/accept-billingBill/{id}', 'BillingBillsController@update');
Route::post('/reject-billingBill/{id}', 'BillingBillsController@reject');*/

Route::get('/student/{id}/report', 'StudentController@report');

Route::get('/student/report/{id}', 'StudentController@prepare_report');
