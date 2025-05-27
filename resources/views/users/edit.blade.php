@extends('layout')
@section('principal')
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Alterar dados</h2>
        @if(session('erro'))
            <p class="text-danger">{{ session('erro') }}</p>
        @endif
        <form action="/editar" method="post">
            @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input value="{{ Auth::user()->name }}" type="text" name="name" class="form-control" id="name" placeholder="Digite seu nome" required>
          </div>
            <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" value="{{ Auth::user()->email }}" name="email" class="form-control" id="email" placeholder="Digite seu e-mail" required>
          </div>
          <div class="mb-3">
            <label for="confirm-password" class="form-label">Informe a senha atual</label>
            <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Digite sua senha" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Informe a nova senha</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Digite sua senha" required>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
        <div class="mb-3 d-grid">
        <a href="/login" class="btn btn-secondary">Voltar para o login!</a>
      </div>
      </div>
    </div>
@endsection