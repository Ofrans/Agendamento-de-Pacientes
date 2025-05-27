@extends('layout')

@section('principal')

    <h1>Consultar Agendamento</h1>
    
    <form method="post" action="/agendamentos/{{ $agendamento->id }}">
        @csrf
        @method('DELETE')
        
        <div class="mb-3">
            <label for="medico_id" class="form-label">Médico: </label>
            <select id="medico_id" name="medico_id" class="form-select" required disabled>
                @foreach ($medicos as $m)
                    <option value="{{ $m->id }}" {{ $agendamento->medico_id == $m->id ? 'selected' : '' }}>
                        {{ $m->user->name }} (CRM: {{ $m->crm }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente: </label>
            <select id="paciente_id" name="paciente_id" class="form-select" required disabled>
                @foreach ($pacientes as $p)
                    <option value="{{ $p->id }}" {{ $agendamento->paciente_id == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" id="data" name="data" value="{{ $agendamento->data }}" class="form-control" required disabled>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora:</label>
            <input type="time" id="hora" name="hora" value="{{ $agendamento->hora }}" class="form-control" required disabled>
        </div>

        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/agendamentos" class="btn btn-primary">Cancelar</a>
    </form>
    
@endsection