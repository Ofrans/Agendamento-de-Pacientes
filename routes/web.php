<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("pacientes", PacienteController::class);
Route::resource("medicos", MedicoController::class);
