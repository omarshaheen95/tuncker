<?php

Route::group(['prefix' => LaravelLocalization::setLocale().'/school'], function () {
    Route::get('/home', function () {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('school')->user();
    
        //dd($users);
    
        return view('school.home');
    })->name('home');

    Route::get('/profile', 'SettingController@profile');
    Route::post('/update-password', 'SettingController@updatePassword');
    Route::post('/update-information', 'SettingController@updateInformation');
    Route::post('/update-image', 'SettingController@updateImage');

    Route::post('/update-image-teacher/{id}', 'SettingController@updateImageTeacher');
    Route::post('/update-password-teacher/{id}', 'SettingController@updatePasswordTeacher');
    Route::post('/update-information-teacher/{id}', 'SettingController@updateInformationTeacher');

    Route::post('/update-image-student/{id}', 'SettingController@updateImageStudent');
    Route::post('/update-information-student/{id}', 'SettingController@updateInformationStudent');

    Route::get('/teacher', 'TeacherController@index');
    Route::get('/teacher/create', 'TeacherController@create');
    Route::post('/teacher/create', 'TeacherController@store');
    Route::get('/teacher/{id}', 'TeacherController@show');
    Route::post('/delete-teacher/{id}', 'TeacherController@deleteTeacher');
    Route::post('/d-e-teacher/{id}', 'TeacherController@disabledTeacher');


    Route::get('/student', 'StudentController@index');
    Route::get('/student/{id}', 'StudentController@show');
    Route::post('/delete-student/{id}', 'StudentController@deleteStudent');
    Route::get('/teacher-students/{id}', 'StudentController@teacherStudents');
    Route::post('/update-subjects-student/{id}', 'StudentController@updateSubjectStudent');

    Route::get('/subject', 'SubjectController@index');
    Route::get('/sub-subject', 'SubSubjectController@index');
    Route::get('/standard', 'StandardController@index');
    Route::get('/sub-subject-standards/{id}', 'StandardController@subjectStandards');
    /*Route::get('/pricing', 'SettingController@pricing');
    Route::post('/billingBills', 'BillingBillsController@store');
    Route::get('/billingBills/{id}', 'BillingBillsController@show');
    Route::get('/billingBills', 'BillingBillsController@index');
    Route::post('/delete-billingBill/{id}', 'BillingBillsController@destroy');*/

    Route::get('/student/{id}/report', 'StudentController@report');

    Route::get('/student/report/{id}', 'StudentController@prepare_report');

  });
