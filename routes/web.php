<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

// Ruta principal
Route::get('/', [MenuController::class, 'index'])->name('home');

// Rutas públicas del menú
Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/add-to-cart', [MenuController::class, 'addToCart'])->name('menu.add-to-cart');
    Route::post('/remove-from-cart', [MenuController::class, 'removeFromCart'])->name('menu.remove-from-cart');
    Route::get('/cart', [MenuController::class, 'showCart'])->name('menu.cart');
    Route::post('/place-order', [MenuController::class, 'placeOrder'])->name('menu.place-order');
    Route::get('/cart-count', [MenuController::class, 'cartCount'])->name('menu.cart-count');
    Route::get('/encuesta', function () {
        return view('encuesta');
    })->name('encuesta');
});

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Panel de administración
    Route::prefix('admin')->group(function () {
        // Platillos
        Route::resource('platillos', PlatilloController::class)->names([
            'index' => 'admin.platillos.index',
            'create' => 'admin.platillos.create',
            'store' => 'admin.platillos.store',
            'show' => 'admin.platillos.show',
            'edit' => 'admin.platillos.edit',
            'update' => 'admin.platillos.update',
            'destroy' => 'admin.platillos.destroy',
        ]);

        // Categorías (nueva adición)
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);

        // Promociones
        Route::resource('promociones', PromotionController::class)
            ->names([
                'index' => 'admin.promociones.index',
                'create' => 'admin.promociones.create',
                'store' => 'admin.promociones.store',
                'show' => 'admin.promociones.show',
                'edit' => 'admin.promociones.edit',
                'update' => 'admin.promociones.update',
                'destroy' => 'admin.promociones.destroy',
            ])
            ->parameters(['promociones' => 'promocion']);

        Route::post('/promociones/{promocion}/toggle-status', [PromotionController::class, 'toggleStatus'])
            ->name('admin.promociones.toggle-status');

        // Pedidos
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::post('/orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('admin.orders.complete');
        Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('admin.orders.cancel');

        // Reportes y configuración
        Route::get('/reportes', [AdminController::class, 'reports'])->name('admin.reportes.index');
        Route::get('/reportes/platillos', function () {
            return view('admin.reportes.platillos');
        })->name('admin.reportes.platillos');
        Route::get('/reportes/encuestas', function () {
            return view('admin.reportes.encuestas');
        })->name('admin.reportes.encuestas');
        Route::get('/configuracion', [AdminController::class, 'configuracion'])->name('admin.configuracion.index');
        Route::put('/configuracion/update-profile', [AdminController::class, 'updateProfile'])
            ->name('admin.configuracion.update-profile');
        Route::put('/configuracion/update-password', [AdminController::class, 'updatePassword'])
            ->name('admin.configuracion.update-password');
    });
   
});

// Eliminar duplicado de ruta home
// Route::get('/home', [HomeController::class, 'index'])->name('home'); // Esta línea está duplicada y debe eliminarse