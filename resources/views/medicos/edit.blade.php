<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Editar Cliente</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
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
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
 </html>