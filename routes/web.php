<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlatoController;
use App\Http\Controllers\Admin\MesaController;
use App\Http\Controllers\Admin\ReservacionAdminController;
use App\Http\Controllers\Admin\UsuarioController;

// ── RUTAS PÚBLICAS ──────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{sede:slug}', [MenuController::class, 'sede'])->name('menu.sede');
Route::get('/sucursales', [HomeController::class, 'sucursales'])->name('sucursales');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

// ── RUTAS AUTENTICADAS (usuario final) ──────────────────
Route::middleware(['auth'])->group(function () {

    // Dashboard de usuario
    Route::get('/mi-cuenta', [ReservacionController::class, 'miCuenta'])->name('cuenta.index');

    // Reservaciones
    Route::get('/reservar', [ReservacionController::class, 'create'])->name('reservaciones.create');
    Route::post('/reservar', [ReservacionController::class, 'store'])->name('reservaciones.store');
    Route::get('/reservar/mesas-disponibles', [ReservacionController::class, 'mesasDisponibles'])->name('reservaciones.mesas');
    Route::delete('/reservaciones/{reservacion}', [ReservacionController::class, 'cancelar'])->name('reservaciones.cancelar');

    // Favoritos
    Route::post('/favoritos/{plato}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
});

// ── RUTAS ADMIN ─────────────────────────────────────────
Route::middleware(['auth', 'role:super_admin,admin_san_salvador,admin_santa_ana,admin_san_miguel'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Platos
    Route::resource('platos', PlatoController::class);

    // Mesas
    Route::resource('mesas', MesaController::class);

    // Reservaciones
    Route::get('reservaciones', [ReservacionAdminController::class, 'index'])->name('reservaciones.index');
    Route::patch('reservaciones/{reservacion}/estado', [ReservacionAdminController::class, 'cambiarEstado'])->name('reservaciones.estado');
    Route::get('reservaciones/reporte', [ReservacionAdminController::class, 'reporte'])->name('reservaciones.reporte');

    // Usuarios (solo super_admin)
    Route::middleware('role:super_admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
    });
});

require __DIR__.'/auth.php';