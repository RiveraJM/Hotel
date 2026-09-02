
<?php

use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\HuespedController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | HABITACIONES
    |--------------------------------------------------------------------------
    */

    Route::get('/habitaciones', [HabitacionController::class, 'index'])
        ->name('habitaciones.index');


    /*
    |--------------------------------------------------------------------------
    | HUÉSPEDES
    |--------------------------------------------------------------------------
    */

    Route::get('/huespedes', [HuespedController::class, 'index'])
        ->name('huespedes.index');

    Route::get('/huespedes/create', [HuespedController::class, 'create'])
        ->name('huespedes.create');


    /*
|--------------------------------------------------------------------------
| RESERVAS
|--------------------------------------------------------------------------
*/

Route::get('/reservas', [ReservaController::class, 'index'])
    ->name('reservas.index');

Route::get('/reservas/crear', [ReservaController::class, 'create'])
    ->name('reservas.create');

Route::post('/reservas', [ReservaController::class, 'store'])
    ->name('reservas.store');


    /*|--------------------------------------------------------------------------
    | CHECK-IN
    |--------------------------------------------------------------------------
    */

    Route::get('/checkin', function () {
        return view('checkin');
    })->name('checkin.index');


    /*
    |--------------------------------------------------------------------------
    | CHECK-OUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout.index');


    /*
    |--------------------------------------------------------------------------
    | LIMPIEZA
    |--------------------------------------------------------------------------
    */

    Route::get('/limpieza', function () {
        return view('limpieza');
    })->name('limpieza.index');


    /*
    |--------------------------------------------------------------------------
    | MANTENIMIENTO
    |--------------------------------------------------------------------------
    */

    Route::get('/mantenimiento', function () {
        return view('mantenimiento');
    })->name('mantenimiento.index');


    /*
    |--------------------------------------------------------------------------
    | CAJA
    |--------------------------------------------------------------------------
    */

    Route::get('/caja', function () {
        return view('caja');
    })->name('caja.index');


    /*
    |--------------------------------------------------------------------------
    | REPORTES
    |--------------------------------------------------------------------------
    */

    Route::get('/reportes', function () {
        return view('reportes');
    })->name('reportes.index');

});


/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';