<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TaskController;
use  App\Http\Controllers\CustomerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[CustomerController::class,'login'])->name('task.login');
Route::get('/login',[CustomerController::class,'login'])->name('task.login');
Route::post('/loginValidate',[CustomerController::class,'loginValidate'])->name('task.loginValidate');

Route::get('/logOut',[CustomerController::class,'logOut'])->name('task.logOut');
Route::get('/signUp',[CustomerController::class,'signUp'])->name('task.signUp');
Route::post('/register',[CustomerController::class,'register'])->name('task.register');
Route::get('/task',[TaskController::class,'index'])->name('task.index');
Route::get('/doneTask',[TaskController::class,'donetask'])->name('task.doneTask');
Route::get('/recycleBin',[TaskController::class,'recycleBin'])->name('task.recycleBin');
Route::get('/task/create',[TaskController::class,'create'])->name('task.create');
Route::post('/task/create',[TaskController::class,'store'])->name('task.store');

Route::get('/task/{task}/edit',[TaskController::class,'edit'])->name('task.edit');

Route::put('/task/{task}/update',[TaskController::class,'update'])->name('task.update');

Route::put('/task/{task}/done',[TaskController::class,'done'])->name('task.done');

Route::put('/task/{task}/undone',[TaskController::class,'undone'])->name('task.undone');

Route::put('/task/{task}/delete',[TaskController::class,'delete'])->name('task.delete');

Route::put('/task/{task}/recover',[TaskController::class,'recover'])->name('task.recover');

Route::delete('/task/{task}/deletePermanently',[TaskController::class,'deletePermanently'])->name('task.deletePermanently');