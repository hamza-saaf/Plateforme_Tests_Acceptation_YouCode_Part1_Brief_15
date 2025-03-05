<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
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

// Route::get('/{prenom}/{nom}',[TestController::class,'index']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('admin.candidates.index');
});
Route::get('/dashboard', function () {
    return view('admin.candidates.dashboard');
});
Route::get('/test/{prenom}/{nom}', function(Request $request){
    dd($request->prenom);
    return view('test',[
        'prenom'=>$request->prenom,
        'nom'=>$request->nom,
    ]);
});
// Route::get('/test', function(){
//     return view('test',[
//         'nom'=>'Hamza',
//         'prenom'=>'saaf',
//         'courses'=> ['HTML','CSS','JS','PHP','MVC']
//     ]);
// });
Route::get('/admin/candidates', [CandidateController::class, 'index'])->name('admin.candidates.index');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';





Route::get('/assignations',function(){
    return view('assignations');
});





Route::get('/cme',function(){
    return view('cme');
});