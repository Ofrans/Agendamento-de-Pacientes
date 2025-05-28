@extends('layout')

@section('principal')
    <h1>Editar Medico</h1>
     
    <form method="post" action="/medicos/{{ $medico-> id }}">
        @csrf
        @method('PUT')
                        
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" value = "{{ $medico->name }}" class="form-control" required="">
        </div>
        
        <div class="mb-3">
            <label for="phone" class="form-label">Telefone:</label>
            <input type="text" id="phone" name="phone" value = "{{ $medico->phone }}" class="form-control" required="">
        </div>

        <div class="mb-3">
            <label for="crm" class="form-label">CRM:</label>
            <input type="text" id="crm" name="crm" value = "{{ $medico->crm }}" class="form-control" required="">
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário: </label>
            <select id="user_id" name="user_id" class="form-select" required="">
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ $medico->user_id == $u->id ? "selected" : ""}} >
                        {{ $u->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade:</label>
                <select id="especialidade" name="especialidade" class="form-select" required>
                    <option value="" disabled>Selecione uma especialidade</option>
                    <option value="Clínico Geral" {{ $medico->especialidade == 'Clínico Geral' ? 'selected' : '' }}>Clínico Geral</option>
                    <option value="Pediatria" {{ $medico->especialidade == 'Pediatria' ? 'selected' : '' }}>Pediatria</option>
                    <option value="Cardiologia" {{ $medico->especialidade == 'Cardiologia' ? 'selected' : '' }}>Cardiologia</option>
                    <option value="Dermatologia" {{ $medico->especialidade == 'Dermatologia' ? 'selected' : '' }}>Dermatologia</option>
                    <option value="Ortopedia" {{ $medico->especialidade == 'Ortopedia' ? 'selected' : '' }}>Ortopedia</option>
                    <option value="Ginecologia" {{ $medico->especialidade == 'Ginecologia' ? 'selected' : '' }}>Ginecologia</option>
                    <option value="Neurologia" {{ $medico->especialidade == 'Neurologia' ? 'selected' : '' }}>Neurologia</option>
                    <option value="Oftalmologia" {{ $medico->especialidade == 'Oftalmologia' ? 'selected' : '' }}>Oftalmologia</option>
                    <option value="Psiquiatria" {{ $medico->especialidade == 'Psiquiatria' ? 'selected' : '' }}>Psiquiatria</option>
                    <option value="Outra" {{ $medico->especialidade == 'Outra' ? 'selected' : '' }}>Outra</option>
                </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection