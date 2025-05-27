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

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@endsection