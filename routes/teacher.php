<?php

Route::group(['prefix' => LaravelLocalization::setLocale().'/teacher'], function () {
    Route::get('/home', function () {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('school')->user();
    
        //dd($users);
        //dd(Auth::user()->school);
        return view('teacher.home');
    })->name('home');
    Route::get('/profile', 'SettingController@profile');
    Route::post('/update-password', 'SettingController@updatePassword');
    Route::post('/update-information', 'SettingController@updateInformation');
    Route::post('/update-image', 'SettingController@updateImage');

    Route::post('/update-image-student/{id}', 'SettingController@updateImageStudent');
    Route::post('/update-information-student/{id}', 'SettingController@updateInformationStudent');

    Route::get('/student', 'StudentController@index');
    Route::get('/student/create', 'StudentController@create');
    Route::post('/student/create', 'StudentController@store');
    Route::get('/student/{id}', 'StudentController@show');
    Route::post('/delete-student/{id}', 'StudentController@deleteStudent');
    Route::post('/update-subjects-student/{id}', 'StudentController@updateSubjectStudent');
    

    Route::get('/subject', 'SubjectController@index');
    Route::get('/sub-subject', 'SubSubjectController@index');
    Route::get('/standard', 'StandardController@index');
    Route::get('/sub-subject-standards/{id}', 'StandardController@subjectStandards');

    Route::get('/students-standards/{id}', 'StandardController@studentStandards');

    Route::post('/update-student-standard', 'StandardController@updateStudentStandard');
    Route::get('/student/{id}/report', 'StudentController@report');

    Route::get('/student/report/{id}', 'StudentController@prepare_report');
    Route::post('/file-students', 'StudentController@import');

  });


