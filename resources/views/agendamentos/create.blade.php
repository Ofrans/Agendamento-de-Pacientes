@extends('layout')

@section('principal')
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

         <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de agendamento:</label>
                <select id="tipo" name="tipo" class="form-select" required>
                    <option value="" selected disabled>Selecione uma tipo</option>
                    <option value="consulta">Consulta</option>
                    <option value="retorno">Retorno</option>
                </select>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status do agendamento:</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="" selected disabled>Selecione um status</option>
                    <option value="agendada">Agendada</option>
                    <option value="feita">Feita</option>
                    <option value="cancelada">Cancelada</option>
                </select>
        </div>
 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
@endsection