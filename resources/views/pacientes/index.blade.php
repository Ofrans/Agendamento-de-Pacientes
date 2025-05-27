@extends('layout')

@section('principal')
    <h1>Paciente</h1>

    <a class="btn btn-primary" href="/pacientes/create">Novo Paciente</a>
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
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Paciente</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Birth Date</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->address }}</td>
                    <td>{{ $p->phone }}</td>
                    <td>{{ $p->birth_date }}</td>
                    <td>
                        <a href="/pacientes/{{ $p->id }}/edit" class="btn btn-warning">Editar</a>
                        <a href="/pacientes/{{ $p->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection