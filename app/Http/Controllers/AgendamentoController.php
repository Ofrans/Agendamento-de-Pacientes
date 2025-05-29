<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medico = Medico::where('user_id', Auth::id())->first();
        if (!$medico) {
            return redirect()->route('medicos.index')->with('erro', 'Nenhum médico cadastrado para este usuário');
        }
        $agendamentos = Agendamento::where('medico_id', $medico->id)->get();
        return view('agendamentos.index', compact('agendamentos'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Busca o médico logado
        $medico = Medico::with('user')->where('user_id', Auth::id())->first();
        
        if (!$medico) {
            return redirect()->route('agendamentos.index')
                ->with('erro', 'Médico não encontrado para o usuário.');
        }
        
        // Carrega apenas os pacientes deste médico
        $pacientes = Paciente::where('medico_id', $medico->id)->get();
        
        return view('agendamentos.create', [
            'medico' => $medico,  // Passa o médico logado (objeto único)
            'pacientes' => $pacientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'tipo' => 'required|in:consulta,retorno',
            'status' => 'required|in:agendada,feita,cancelada'
        ]);

        try {
            // Cria o agendamento com os dados validados
            Agendamento::create($validatedData);
            
            return redirect()->route('agendamentos.index')
                ->with('sucesso', 'Agendamento cadastrado com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar agendamento: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Erro ao criar agendamento: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agendamento = Agendamento::with(['medico.user', 'paciente'])->findOrFail($id);
        $medicos = Medico::with('user')->get();
        $pacientes = Paciente::all(); // Ou User::where(...)->get() se for o caso
        
        return view('agendamentos.show', compact('agendamento', 'medicos', 'pacientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $medicos = Medico::with('user')->get();
        $pacientes = Paciente::all(); // Ou User::where(...)->get()
        
        return view('agendamentos.edit', compact('agendamento', 'medicos', 'pacientes'));
    }

   public function update(Request $request, string $id)
    {
        try {
            $agendamento = Agendamento::findOrFail($id);
            
            // Validação simplificada mas segura
            $agendamento->update([
                'medico_id' => $request->medico_id,
                'paciente_id' => $request->paciente_id,
                'data' => $request->data,
                'hora' => substr($request->hora, 0, 5), // Garante o formato HH:MM
                'tipo' => $request->tipo,
                'status' => $request->status
            ]);
            
            return redirect()->route('agendamentos.index')
                ->with('sucesso', 'Agendamento alterado com sucesso!');
                
        } catch (Exception $e) {
            Log::error("Erro ao atualizar agendamento", [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Erro ao editar: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $agendamento = Agendamento::findOrFail($id);
            $agendamento->delete();
            return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento excluído com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao excluir o agendamento: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'agendamento_id' => $id
            ]);
            return redirect()->route('agendamentos.index')->with('erro','Erro ao excluir!');
        }
    }
}
