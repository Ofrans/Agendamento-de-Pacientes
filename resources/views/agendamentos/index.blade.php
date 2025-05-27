@extends('layout')

@section('principal')

    <h1>Agendamentos</h1>

    <a class="btn btn-primary" href="/agendamentos/create">Novo Agendamento</a>
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
                <th>Nome do Paciente</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendamentos as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->medico->name  }}</td>
                    <td>{{ $c->paciente->name }}</td>
                    <td>{{ $c->data }}</td>
                    <td>{{ $c->hora }}</td>
                    <td>
                        <a href="/agendamentos/{{ $c->id }}/edit/" class="btn btn-warning">Editar</a>
                        <a href="/agendamentos/{{ $c->id }}/" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection