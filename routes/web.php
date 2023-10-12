<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use app\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});*/
/*
Route::get('/',function(){
 return view('layouts.index');
})->name('index');*/

Route::get('/',[App\Http\Controllers\TaskController::class,'index'])->name('index');
Route::get('/Create',[App\Http\Controllers\TaskController::class,'create'])->name('Create');
Route::post('/',[App\Http\Controllers\TaskController::class,'store'])->name('store');
Route::delete('/{id}', [App\Http\Controllers\TaskController::class, 'delete'])->name('delete');
Route::get('/tarea/{id}/editar', [App\Http\Controllers\TaskController::class, 'edit'])->name('edit');
Route::post('/tarea/{id}/actualizar', [App\Http\Controllers\TaskController::class, 'update'])->name('update');




