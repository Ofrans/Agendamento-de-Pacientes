<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Novo Médico</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
     <h1>Novo Agendamento</h1>
     
     <form method="post" action="/agendamentos">
         @csrf
                         
         <div class="mb-3">
            <label for="medico_id" class="form-label">Nome do Médico: </label>
            <select id="medico_id" name="medico_id" class="form-select" required>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}">
                        {{ $medico->user->name }}
                    </option>
                @endforeach
            </select>
        </div>
         
         <div class="mb-3">
             <label for="paciente_id" class="form-label">Nome do Paciente </label>
             <select id="paciente_id" name="paciente_id" class="form-select" required="">
                 @foreach ($pacientes as $p)
                     <option value="{{ $p->id }}">
                         {{ $p->name }}
                     </option>
                 @endforeach
             </select>
         </div>

         <div class="mb-3">
             <label for="data" class="form-label">Data:</label>
             <input type="date" id="data" name="data" class="form-control" required="">
         </div>
 
         <div class="mb-3">
             <label for="hora" class="form-label">Hora:</label>
             <input type="time" id="hora" name="hora" class="form-control" required="">
         </div>
 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
             
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
 </html>