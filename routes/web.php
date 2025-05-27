<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/login');
});

Route::get("/login", [AuthController::class, 'showFormLogin'])->name('login');
Route::post("/login", [AuthController::class, 'login']);

Route::get("/cadastro", [UserController::class, 'create']);
Route::post("/cadastro", [UserController::class, 'store']);


Route::middleware("auth")->group(function () {
    Route::resource("pacientes", PacienteController::class);
    Route::resource("medicos", MedicoController::class);
    Route::resource("agendamentos", AgendamentoController::class);
    Route::post("/logout", [AuthController::class,'logout']);
    Route::get("/editar", [UserController::class, 'edit']);
    Route::post("/editar", [UserController::class, 'update']);

});