@extends('layout')

@section('principal')
    <h1>Editar Agendamento</h1>
     
    <form method="post" action="/agendamentos/{{ $agendamento-> id }}">
        @csrf
        @method('PUT')
                        
        <div class="mb-3">
            <label for="medico_id" class="form-label">Nome do Médico: </label>
            <select id="medico_id" name="medico_id" class="form-select" required>
                @foreach ($medicos as $m)
                    <option value="{{ $m->id }}" {{ $agendamento->medico_id == $m->id ? 'selected' : '' }}>
                        {{ $m->user->name }} (CRM: {{ $m->crm }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Nome do Paciente: </label>
            <select id="paciente_id" name="paciente_id" class="form-select" required="">
                @foreach ($pacientes as $p)
                    <option value="{{ $p->id }}" {{ $agendamento->paciente_id == $p->id ? "selected" : ""}} >
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" id="data" name="data" value = "{{ $agendamento->data }}" class="form-control" required="">
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora:</label>
            <input type="time" id="hora" name="hora" value = "{{ $agendamento->hora }}" class="form-control" required="">
        </div>
        
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
                <select id="tipo" name="tipo" class="form-select" required>
                    <option value="" disabled>Selecione um tipo</option>
                    <option value="consulta" {{ $agendamento->tipo == 'consulta' ? 'selected' : '' }}>consulta</option>
                    <option value="retorno" {{ $agendamento->tipo == 'retorno' ? 'selected' : '' }}>retorno</option>
                </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label> <!-- Corrigido o for="" -->
                <select id="status" name="status" class="form-select" required> <!-- Corrigido id e name -->
                    <option value="" disabled>Selecione um status</option>
                    <option value="agendada" {{ $agendamento->status == 'agendada' ? 'selected' : '' }}>agendada</option>
                    <option value="feita" {{ $agendamento->status == 'feita' ? 'selected' : '' }}>feita</option>
                    <option value="cancelada" {{ $agendamento->status == 'cancelada' ? 'selected' : '' }}>cancelada</option>
                </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection