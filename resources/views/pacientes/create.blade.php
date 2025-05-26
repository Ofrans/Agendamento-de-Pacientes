<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Novo Paciente</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
     <h1>Novo Paciente</h1>
     
     <form method="post" action="/pacientes">
         @csrf
                         
         <div class="mb-3">
             <label for="name" class="form-label">Nome:</label>
             <input type="text" id="name" name="name" class="form-control" required>
         </div>

         <div class="mb-3">
             <label for="email" class="form-label">Email:</label>
             <input type="text" id="email" name="email" class="form-control" required>
         </div>
         
         <div class="mb-3">
             <label for="phone" class="form-label">Telefone:</label>
             <input type="text" id="phone" name="phone" class="form-control" required>
         </div>

         <div class="mb-3">
             <label for="address" class="form-label">Endereço:</label>
             <input type="text" id="address" name="address" class="form-control" required>
         </div>
 
         <div class="mb-3">
    <label for="birth_date" class="form-label">Data de Nascimento:</label>
    <input type="date" id="birth_date" name="birth_date" class="form-control" required>
</div>

 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
             
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
</html>