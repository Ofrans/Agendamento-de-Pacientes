@extends('layout')

@section('principal')
    <h1>Médicos</h1>

    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-primary" href="/medicos/create">Novo Médico</a>
        
        <!-- Formulário de Filtro -->
        <form method="GET" action="{{ route('medicos.index') }}" class="form-inline">
            <div class="input-group">
                <select name="especialidade" id="especialidade" class="form-select">
                    <option value="">Todas as especialidades</option>
                    @foreach($especialidades as $esp)
                        <option value="{{ $esp->especialidade }}" 
                            {{ request('especialidade') == $esp->especialidade ? 'selected' : '' }}>
                            {{ $esp->especialidade }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary">Filtrar</button>
                @if(request('especialidade'))
                    <a href="{{ route('medicos.index') }}" class="btn btn-outline-secondary">Limpar</a>
                @endif
            </div>
        </form>
    </div>

    @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome do Médico</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CRM</th>
                <th>Especialidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($medicos as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->user->email }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->crm }}</td>
                    <td>{{ $c->especialidade }}</td>
                    <td>
                        <a href="/medicos/{{ $c->id }}/edit/" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/medicos/{{ $c->id }}/" class="btn btn-info btn-sm">Consultar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum médico encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection