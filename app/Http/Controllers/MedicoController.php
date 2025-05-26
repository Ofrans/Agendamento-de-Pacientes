<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicos = Medico::with('user')->get();
        return view("medicos.index", compact('medicos'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view("medicos.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Medico::create($request->all());
            return redirect()->route('medicos.index')->with('sucesso', 'Medico inserido com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar o medico: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('medicos.index')->with('erro', 'Erro ao criar o medico!');
        }
    }
}
