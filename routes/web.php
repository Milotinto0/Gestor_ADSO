<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AprendizController;
use App\Http\Controllers\UserController;
use App\Models\Aprendiz;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

// Redirige la raíz al listado de aprendices
Route::redirect('/', '/aprendices');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard (Breeze)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |----------------------------------------------------------------------
    | Aprendices (con autorización por rol)
    |----------------------------------------------------------------------
    */

    // Listado — todos los roles autenticados
    Route::get('aprendices', [AprendizController::class, 'index'])
        ->middleware('can:viewAny,' . Aprendiz::class)
        ->name('aprendices.index');

    // Crear — admin e instructor
    Route::get('aprendices/create', [AprendizController::class, 'create'])
        ->middleware('can:create,' . Aprendiz::class)
        ->name('aprendices.create');

    Route::post('aprendices', [AprendizController::class, 'store'])
        ->middleware('can:create,' . Aprendiz::class)
        ->name('aprendices.store');

    // Ver detalle — todos los roles
    Route::get('aprendices/{aprendiz}', [AprendizController::class, 'show'])
        ->middleware('can:view,aprendiz')
        ->name('aprendices.show');

    // Editar — admin e instructor
    Route::get('aprendices/{aprendiz}/edit', [AprendizController::class, 'edit'])
        ->middleware('can:update,aprendiz')
        ->name('aprendices.edit');

    Route::put('aprendices/{aprendiz}', [AprendizController::class, 'update'])
        ->middleware('can:update,aprendiz')
        ->name('aprendices.update');

    // Eliminar — solo admin (con restricciones en la Policy)
    Route::delete('aprendices/{aprendiz}', [AprendizController::class, 'destroy'])
        ->middleware('can:delete,aprendiz')
        ->name('aprendices.destroy');

    /*
        USUARIOS (con autorización por rol)
        */
    Route::get('users', [UserController::class, 'index'])
        ->middleware('can:viewAny,' . User::class)
        ->name('users.index');

    Route::get('users/create', [UserController::class, 'create'])
        ->middleware('can:create,' . User::class)
        ->name('users.create');

    Route::post('users', [UserController::class, 'store'])
        ->middleware('can:create,' . User::class)
        ->name('users.store');

    Route::get('users/{usuario}/edit', [UserController::class, 'edit'])
        ->middleware('can:update,usuario')
        ->name('users.edit');

    Route::put('users/{usuario}', [UserController::class, 'update'])
        ->middleware('can:update,usuario')
        ->name('users.update');

    Route::delete('users/{usuario}', [UserController::class, 'destroy'])
        ->middleware('can:delete,usuario')
        ->name('users.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
