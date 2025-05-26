<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        try {
            Paciente::create($request->all());
            return redirect()->route('pacientes.index')->with('sucesso', 'Paciente criado com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar paciente: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            return redirect()->route('pacientes.index')->with('erro', 'Erro ao criar paciente!');
        }
    }

    public function show(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.show', compact('paciente'));
    }

    public function edit(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $paciente = Paciente::findOrFail($id);
            $paciente->update($request->all());
            return redirect()->route('pacientes.index')->with('sucesso', 'Paciente atualizado com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao atualizar paciente: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'paciente_id' => $id,
                'request' => $request->all(),
            ]);
            return redirect()->route('pacientes.index')->with('erro', 'Erro ao atualizar paciente!');
        }
    }

    public function destroy(string $id)
    {
        try {
            $paciente = Paciente::findOrFail($id);
            $paciente->delete();
            return redirect()->route('pacientes.index')->with('sucesso', 'Paciente excluído com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao excluir paciente: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'paciente_id' => $id,
            ]);
            return redirect()->route('pacientes.index')->with('erro', 'Erro ao excluir paciente!');
        }
    }
}
