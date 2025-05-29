<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Medico;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    public function index()
    {
        // Busca o médico associado ao usuário logado
        $medico = Medico::where('user_id', Auth::id())->first();
        
        if (!$medico) {
            return redirect()->route('agendamentos.index')->with('erro', 'Médico não encontrado para o usuário.');
        }
        
        // Busca apenas os agendamentos do médico logado, com eager loading das relações
        $agendamentos = Agendamento::with(['medico', 'paciente'])
            ->where('medico_id', $medico->id)
            ->get();
        
        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $medico = Medico::where('user_id', Auth::id())->first();
        return view('pacientes.create', compact('medico'));
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
        $medicos = Medico::all(); // Carrega todos os médicos do banco de dados
        return view('pacientes.show', compact('paciente', 'medicos'));
    }

    public function edit(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        $medico = Medico::where('user_id', Auth::id())->first();
        return view('pacientes.edit', compact('paciente', 'medico'));
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