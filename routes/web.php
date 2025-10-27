<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CategoriaController;


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

Route::group(['middleware' => ['authUser']], function () {
    
    //Contactos
    Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
    Route::get('/contactos/create', [ContactoController::class, 'create'])->name('contactos.create');
    Route::post('/contactos', [ContactoController::class, 'store'])->name('contactos.store');
    Route::get('/contactos/{contacto}/edit', [ContactoController::class, 'edit'])->name('contactos.edit');
    Route::put('/contactos/{contacto}', [ContactoController::class, 'update'])->name('contactos.update');
    Route::delete('/contactos/{contacto}', [ContactoController::class, 'destroy'])->name('contactos.destroy');
});

Route::group(['middleware' => ['authUser']], function () {
    
    //Categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});