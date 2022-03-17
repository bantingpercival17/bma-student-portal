<?php

use App\Http\Controllers\StudentController;
use App\Models\StudentDetails;
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

require __DIR__ . '/auth.php';
require __DIR__ . '/route-student.php';
require __DIR__ . '/route-website.php';
