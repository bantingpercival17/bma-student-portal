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
    Route::get('/grades', [StudentController::class, 'grades_view'])->name('grades');
    Route::get('/payments', [StudentController::class, 'payments_view'])->name('payments');
});
