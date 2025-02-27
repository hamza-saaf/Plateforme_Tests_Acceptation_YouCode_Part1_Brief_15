<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
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
    return view('welcome');
});
Route::get('/index', function () {
    return view('admin.candidates.index');
});
Route::get('/dashboard', function () {
    return view('admin.candidates.dashboard');
});
Route::get('/admin/candidates', [CandidateController::class, 'index'])->name('admin.candidates.index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
