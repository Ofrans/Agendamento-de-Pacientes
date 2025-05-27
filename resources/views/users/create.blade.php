@extends('layout')

@section('principal')
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Novo usuário</h2>
        @if(session('erro'))
            <p class="text-danger">{{ session('erro') }}</p>
        @endif
        <form action="/cadastro" method="post">
            @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Digite seu nome" required>
          </div>
            <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Digite sua senha" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
        <div class="mb-3">
        <a href="/login" class="btn btn-secondary">Voltar para o login!</a>
      </div>
      </div>
    </div>
@endsection