<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Editar Cliente</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
    <h1>Editar Agendamento</h1>
     
    <form method="post" action="/agendamentos/{{ $agendamento-> id }}">
        @csrf
        @method('PUT')
                        
        <div class="mb-3">
            <label for="medico_id" class="form-label">Nome do Médico: </label>
            <select id="medico_id" name="medico_id" class="form-select" required>
                @foreach ($medicos as $m)
                    <option value="{{ $m->id }}" {{ $agendamento->medico_id == $m->id ? 'selected' : '' }}>
                        {{ $m->user->name }} (CRM: {{ $m->crm }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Nome do Paciente: </label>
            <select id="paciente_id" name="paciente_id" class="form-select" required="">
                @foreach ($pacientes as $p)
                    <option value="{{ $p->id }}" {{ $agendamento->paciente_id == $p->id ? "selected" : ""}} >
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" id="data" name="data" value = "{{ $agendamento->data }}" class="form-control" required="">
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora:</label>
            <input type="time" id="hora" name="hora" value = "{{ $agendamento->hora }}" class="form-control" required="">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
 </html>