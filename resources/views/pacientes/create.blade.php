@extends('layout')

@section('principal')
 
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

        <input type="hidden" name="medico_id" value="{{ $medico->id }}">

        <div class="mb-3">
            <label class="form-label">Médico:</label>
            <input type="text" class="form-control" value="{{ $medico->name }}" readonly>
        </div>
</div>

 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
@endsection