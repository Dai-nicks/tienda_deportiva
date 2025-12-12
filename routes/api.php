<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PersonalizacionController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DetalleCarritoController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;


Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('personalizaciones', PersonalizacionController::class);
Route::apiResource('carritos', CarritoController::class);
Route::apiResource('detalles_carrito', DetalleCarritoController::class);
Route::apiResource('detalles_pedido', DetallePedidoController::class);
Route::apiResource('pagos', PagoController::class);
Route::post('/login', [AuthController::class, 'login']);
