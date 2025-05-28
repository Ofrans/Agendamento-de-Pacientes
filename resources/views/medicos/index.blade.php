@extends('layout')

@section('principal')
    <h1>Medicos</h1>

    <a class="btn btn-primary" href="/medicos/create">Novo Medico</a>
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
                <th>Nome do Medico</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CRM</th>
                <th>Especialidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicos as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->user->email }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->crm }}</td>
                    <td>{{ $c->especialidade }}</td>
                    <td>
                        <a href="/medicos/{{ $c->id }}/edit/" class="btn btn-warning">Editar</a>
                        <a href="/medicos/{{ $c->id }}/" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection