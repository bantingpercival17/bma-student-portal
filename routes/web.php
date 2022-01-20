<?php

use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return redirect('/login');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
 */
require __DIR__ . '/auth.php';


Route::prefix('student')->middleware(['auth:student'])->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('home');
    Route::get('/home', [StudentController::class, 'index'])->name('home');
    Route::get('/academic', [StudentController::class, 'academic_view'])->name('academic');
    Route::get('/academic/grades', [StudentController::class, 'academic_grades'])->name('academic.grades');
    Route::get('/academic/clearance', [StudentController::class, 'academic_clearance'])->name('academic.clearance');
    Route::get('/academic/enroll-now', [StudentController::class, 'enrollment_application'])->name('academic.enroll-now');

    Route::get('/grades', [StudentController::class, 'grades_view'])->name('grades');
    Route::get('/payments', [StudentController::class, 'payments_view'])->name('payments');

    /* Enrollment */
    Route::get('/enrollment', [StudentController::class, 'enrollment_view'])->name('enrollment');



    // Onboard Training
    Route::get('/on-board', [StudentController::class, 'onboard_view'])->name('on-board');
    Route::post('/on-board/pre-deployment', [StudentController::class, 'onboard_pre_deployment_store'])->name('onboard.pre_deployment');
    Route::get('/on-board/journal', [StudentController::class, 'create_journal'])->name('onboard.journal');
    Route::post('/on-board/journal', [StudentController::class, 'store_journal'])->name('onboard.store-journal');
    Route::get('/on-board/journal/view', [StudentController::class, 'view_journal'])->name('onboard.view-journal');
});
