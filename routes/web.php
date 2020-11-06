<?php
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CheckStatus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(CheckStatus::class);
Route::resource('admin','App\Http\Controllers\AdminCon')->middleware(CheckStatus::class);
Route::get('/admin/delete/{id}', 'App\Http\Controllers\AdminCon@destroy')->name('admin.destroy');
Route::get('/grade',function(){
    $data = DB::table('users')->whereRaw('approve = true and role <> "admin"')->get();
       return view('admin.grade',compact(['data']));
});
Route::get('/updategrade','App\Http\Controllers\AdminCon@update');
?>
