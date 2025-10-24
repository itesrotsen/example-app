<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyectoController;

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'attempt'])->name('login.attempt');
});


Route::group(['middleware' => ['authUser']], function () {
    //Dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'createForm'])->name('tasks.createForm');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});

Route::group(['middleware' => ['authUser']], function () {
    //Proyectos
    Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
    Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
    Route::get('/proyectos/{proyecto}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::put('/proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::delete('/proyectos/{proyecto}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
});
