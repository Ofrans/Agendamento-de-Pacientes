<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Clínica Médica</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Clínica Médica</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarConteudo" aria-controls="navbarConteudo" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarConteudo">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/pacientes">Pacientes</a>
          </li>
<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/medicos">Médicos</a>
          </li>
<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/agendamentos">Agendamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/editar">Perfil</a>
          </li>
        </ul>

        <!-- Botão de logout -->
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="btn btn-danger">Sair</button>
        </form>
      </div>
    </div>
  </nav>

  @yield('principal')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>