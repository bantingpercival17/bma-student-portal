<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::prefix('bma')->group(function () {
    Route::get('/', [WebsiteController::class, 'index'])->name('website.home');
    Route::get('/admission', [WebsiteController::class, 'admission_view'])->name('website.admission');
    Route::get('/about-us', [WebsiteController::class, 'index'])->name('website.about-us');


    Route::get('/contact-us', [WebsiteController::class, 'contact_us_view'])->name('website.contact-us');
});
