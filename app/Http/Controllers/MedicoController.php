<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Medico::with('user');
        
        // Filtro por especialidade
        if ($request->has('especialidade') && $request->especialidade != '') {
            $query->where('especialidade', 'like', '%' . $request->especialidade . '%');
        }
        
        $medicos = $query->get();
        
        // Para o dropdown de filtro
        $especialidades = Medico::select('especialidade')
            ->distinct()
            ->orderBy('especialidade')
            ->get();
            
        return view("medicos.index", compact('medicos', 'especialidades'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'crm' => 'required|string|unique:medicos|max:20',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('medicos')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user_id);
                })
            ]
        ]);

        try {
            // Verifica se o usuário já está vinculado a outro médico
            if (Medico::where('user_id', $request->user_id)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('erro', 'Este usuário já está vinculado a outro médico!');
            }

            Medico::create($request->all());
            
            return redirect()->route('medicos.index')
                ->with('sucesso', 'Médico cadastrado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Erro ao cadastrar médico: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medico = Medico::findOrFail($id);
        $users = User::all();
        return view("medicos.show", compact('medico', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medico = Medico::findOrFail($id);
        $users = User::all();
        return view("medicos.edit", compact('medico', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $medico = Medico::findOrFail($id);
            $medico->update($request->all());
            return redirect()->route('medicos.index')->with('sucesso', 'Medico alterado com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao atualizar o medico: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'medico_id' => $id,
	            'request' => $request->all()
            ]);
            return redirect()->route('medicos.index')->with('erro','Erro ao editar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $medico = Medico::findOrFail($id);
            $medico->delete();
            return redirect()->route('medicos.index')->with('sucesso', 'Medico excluído com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao excluir o medico: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'medico_id' => $id
            ]);
            return redirect()->route('medicos.index')->with('erro','Erro ao excluir!');
        }
    }
}
