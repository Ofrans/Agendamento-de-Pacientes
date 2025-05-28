@extends('layout')

@section('principal')
    <h1>Consultar Medico</h1>
    
    <form method="post" action="/medicos/{{ $medico-> id }}">
        @csrf
        @method('DELETE')        
                        
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
            <input type="text" id="especialidade" name="especialidade" value = "{{ $medico->especialidade }}" class="form-control" required="">
        </div>

        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/medicos" class="btn btn-primary">Cancelar</a>
    </form>
@endsection