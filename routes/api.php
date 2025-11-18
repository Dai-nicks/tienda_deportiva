<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('producros', ProductoController::class);