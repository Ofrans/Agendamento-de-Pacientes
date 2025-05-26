<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\Log;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendamentos = Agendamento::with('medico',"paciente")->get();
        return view("agendamentos.index", compact('agendamentos'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicos = Medico::with('user')->get(); // Carrega médicos com seus usuários
        $pacientes = Paciente::all(); // Ou User::where('tipo', 'paciente')->get();
    
        return view('agendamentos.create', compact('medicos', 'pacientes'));
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
            'hora' => 'required|date_format:H:i'
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'medico_id' => 'required|exists:medicos,id',
        'paciente_id' => 'required|exists:pacientes,id',
        'data' => 'required|date',
        'hora' => 'required|date_format:H:i'
        ]);

        try {
            $agendamento = Agendamento::findOrFail($id);
            $agendamento->update($validated);
            
            return redirect()->route('agendamentos.index')
                ->with('sucesso', 'Agendamento atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Erro ao atualizar: ' . $e->getMessage());
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
