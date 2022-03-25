<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::prefix('bma')->group(function () {
    Route::get('/', [WebsiteController::class, 'index'])->name('website.home');
    Route::get('/admission', [WebsiteController::class, 'admission_view'])->name('website.admission');; // Admission View
    Route::get('/about-us', [WebsiteController::class, 'index'])->name('website.about-us'); // 
    Route::get('/contact-us', [WebsiteController::class, 'contact_us_view'])->name('website.contact-us');
    Route::post('/admission', [WebsiteController::class, 'admission_store'])->name('website.admission-store');


    Route::get('/login', [WebsiteController::class, 'login_view'])->name('applicant-view')->middleware('guest:applicant');
    Route::post('/login', [WebsiteController::class, 'login'])->name('applicant-login')->middleware('guest:applicant');
    Route::prefix('applicant')->middleware(['auth:applicant'])->group(function () {
        Route::get('/', [ApplicantController::class, 'index'])->name('applicant.home');
        Route::get('/student-information', [ApplicantController::class, 'applicant_view'])->name('applicant.student-view');
        Route::post('/applicant', [ApplicantController::class, 'create_applicant_details'])->name('applicant.store-detials');
        Route::post('/applicant/logout', [ApplicantController::class, 'logout'])->name('applicant.logout');
    });
});
