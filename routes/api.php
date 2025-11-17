<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('categorias', CategoriaController::class);