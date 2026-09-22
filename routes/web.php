
<?php

use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LimpiezaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\MantenimientoController;
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

    Route::get('/habitaciones/{habitacion}', [HabitacionController::class, 'show'])
        ->name('habitaciones.show');

    Route::patch('/habitaciones/{habitacion}/status', [HabitacionController::class, 'updateStatus'])
        ->name('habitaciones.updateStatus');

    Route::post('/habitaciones', [HabitacionController::class, 'store'])
        ->name('habitaciones.store');


    /*
    |--------------------------------------------------------------------------
    | HUÉSPEDES
    |--------------------------------------------------------------------------
    */

    Route::get('/huespedes', [HuespedController::class, 'index'])
        ->name('huespedes.index');

    Route::get('/huespedes/create', [HuespedController::class, 'create'])
        ->name('huespedes.create');

    Route::get('/huespedes/{huesped}/edit', [HuespedController::class, 'edit'])
        ->name('huespedes.edit');

    Route::post('/huespedes', [HuespedController::class, 'store'])
        ->name('huespedes.store');

    Route::put('/huespedes/{huesped}', [HuespedController::class, 'update'])
        ->name('huespedes.update');

    Route::delete('/huespedes/{huesped}', [HuespedController::class, 'destroy'])
        ->name('huespedes.destroy');


    /*
|--------------------------------------------------------------------------
| RESERVAS
|--------------------------------------------------------------------------
*/

Route::get('/reservas', [ReservaController::class, 'index'])
    ->name('reservas.index');

Route::get('/reservas/crear', [ReservaController::class, 'create'])
    ->name('reservas.create');

Route::get('/reservas/{reserva}/editar', [ReservaController::class, 'edit'])
    ->name('reservas.edit');

Route::get('/reservas/habitacion/{habitacion}/asignar', [ReservaController::class, 'assignGuest'])
    ->name('reservas.assign');

Route::post('/reservas', [ReservaController::class, 'store'])
    ->name('reservas.store');

Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])
    ->name('reservas.update');

Route::post('/reservas/habitacion/{habitacion}/asignar', [ReservaController::class, 'storeAssignedGuest'])
    ->name('reservas.assign.store');


    /*|--------------------------------------------------------------------------
    | CHECK-IN
    |--------------------------------------------------------------------------
    */

    Route::get('/checkin', [CheckinController::class, 'index'])
        ->name('checkin.index');

    Route::post('/checkin/search', [CheckinController::class, 'search'])
        ->name('checkin.search');

    Route::post('/checkin', [CheckinController::class, 'store'])
        ->name('checkin.store');


    /*
    |--------------------------------------------------------------------------
    | CHECK-OUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::get('/checkout/search', [CheckoutController::class, 'search'])
        ->name('checkout.search');

    Route::post('/checkout/{reserva}', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::get('/checkout/{reserva}/comprobante', [CheckoutController::class, 'receipt'])
        ->name('checkout.receipt');

    Route::get('/factura/{reserva}', [CheckoutController::class, 'receipt'])
        ->name('factura.show');

    Route::get('/factura/movimiento/{movimiento}', [CheckoutController::class, 'movementReceipt'])
        ->name('factura.movement');


    /*
    |--------------------------------------------------------------------------
    | LIMPIEZA
    |--------------------------------------------------------------------------
    */

    Route::get('/limpieza', [LimpiezaController::class, 'index'])
        ->name('limpieza.index');

    Route::patch('/limpieza/{habitacion}', [LimpiezaController::class, 'update'])
        ->name('limpieza.update');


    /*
    |--------------------------------------------------------------------------
    | MANTENIMIENTO
    |--------------------------------------------------------------------------
    */

    Route::get('/mantenimiento', [MantenimientoController::class, 'index'])
        ->name('mantenimiento.index');

    Route::post('/mantenimiento', [MantenimientoController::class, 'store'])
        ->name('mantenimiento.store');

    Route::patch('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'update'])
        ->name('mantenimiento.update');

    Route::delete('/mantenimiento/{mantenimiento}', [MantenimientoController::class, 'destroy'])
        ->name('mantenimiento.destroy');


    /*
    |--------------------------------------------------------------------------
    | CAJA
    |--------------------------------------------------------------------------
    */

    Route::get('/caja', [CajaController::class, 'index'])
        ->name('caja.index');

    Route::post('/caja/apertura', [CajaController::class, 'open'])
        ->name('caja.open');

    Route::post('/caja/movimientos', [CajaController::class, 'storeMovement'])
        ->name('caja.movements.store');

    Route::post('/caja/cierre', [CajaController::class, 'close'])
        ->name('caja.close');


    /*
    |--------------------------------------------------------------------------
    | REPORTES
    |--------------------------------------------------------------------------
    */

    Route::get('/reportes', [ReporteController::class, 'index'])
        ->name('reportes.index');

});


/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';