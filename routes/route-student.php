<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::prefix('student')->middleware(['auth:student'])->group(function () {
    //Route::get('/', [StudentController::class, 'index'])->name('home');
    //Route::get('/home', [StudentController::class, 'index'])->name('home');
    Route::get('/', [StudentController::class, 'index'])->name('home');
    Route::get('/home', [StudentController::class, 'index'])->name('home');

    /* Academic Procedure */
    Route::get('/academic', [StudentController::class, 'academic_view'])->name('academic');
    Route::get('/academic/subject-class', [StudentController::class, 'academic_subject_class'])->name('academic.subject-class');
    Route::get('/academic/subject-lesson', [StudentController::class, 'academic_subject_lesson'])->name('academic.subject-lesson');


    Route::get('/academic/grades', [StudentController::class, 'academic_grades'])->name('academic.grades');
    Route::get('/academic/clearance', [StudentController::class, 'academic_clearance'])->name('academic.clearance');

    Route::get('/student-manual', [StudentController::class, 'view_student_manual'])->name('student-manual');
    Route::post('/student-manual', [StudentController::class, 'store_student_manual'])->name('student-handbook');
    Route::get('/grades', [StudentController::class, 'grades_view'])->name('grades');
    Route::get('/payments', [StudentController::class, 'payments_view'])->name('payments');


    /* Enrollment */
    Route::get('/enrollment', [StudentController::class, 'enrollment_view'])->name('enrollment');
    Route::get('/enrollment/coe', [StudentController::class, 'enrollment_report_view'])->name('enrollment.coe');


    // Onboard Training
    Route::get('/on-board', [StudentController::class, 'onboard_view'])->name('on-board');
    Route::post('/on-board/pre-deployment', [StudentController::class, 'onboard_pre_deployment_store'])->name('onboard.pre_deployment');
    Route::get('/on-board/journal', [StudentController::class, 'create_journal'])->name('onboard.journal');
    Route::post('/on-board/journal', [StudentController::class, 'store_journal'])->name('onboard.store-journal');
    Route::get('/on-board/journal/view', [StudentController::class, 'view_journal'])->name('onboard.view-journal');
    Route::post('/on-board/journal/file-upload', [StudentController::class, 'upload_journal_file'])->name('onboard.file-upload');
    Route::post('/on-board/journal/file-recent-upload', [StudentController::class, 'recent_upload_journal_file'])->name('onboard.recent-file-upload');
    Route::post('/on-board/journal/file-reupload', [StudentController::class, 'reupload_journal_file'])->name('onboard.reupload-file');
    Route::get('/on-board/journal/remove', [StudentController::class, 'remove_journal'])->name('onboard.journal-remove');
    Route::post('/on-board/assessments', [StudentController::class, 'onboard_examination'])->name('onboard.assessment');
    Route::get('/on-board/assessments-view/{data}', [StudentController::class, 'onboard_examination_view'])->name('onboard.assessment-view');

    Route::get('/student-profile/update', [StudentController::class, 'view_student_profile'])->name('update-profile');
    Route::post('/student-profile/update-store', [StudentController::class, 'update_student_profile'])->name('update-student-profile');

    Route::get('/student-profile/account', [StudentController::class, 'account_view'])->name('student.accounts');
    Route::post('/student-profile/account/reset-password', [StudentController::class, 'student_change_password'])->name('student.change-password');

    Route::get('/attendance', [StudentController::class, 'attendance_form_view'])->name('bma-qrcode');
    Route::post('/attendance', [StudentController::class, 'attendance_store'])->name('bma-qrcode-generate');


    // Enrollment Procedure
    Route::get('/academic/enroll-now', [StudentController::class, 'enrollment_application'])->name('academic.enroll-now');
    Route::get('/enrollment/registration-form-fillup', [StudentController::class, 'enrollment_registration_form'])->name('enrollment.registration-form-fillup');
    Route::post('/enrollment/registration-form-fillup', [StudentController::class, 'enrollment_registration_store'])->name('enrollment.registration-form-store');
    Route::get('/enrollment/registration-form', [StudentController::class, 'registration_form'])->name('enrollment.registration-form');
    Route::post('enrollment/payment-application', [StudentController::class, 'payment_application'])->name('enrollment.payment-mode');
    Route::post('enrollment/payments/payment-transaction', [StudentController::class, 'payment_store'])->name('enrollment.online-transaction-payment');
});
