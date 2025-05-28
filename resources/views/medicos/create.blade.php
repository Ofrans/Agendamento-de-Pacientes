@extends('layout')

@section('principal')
     <h1>Novo Médico</h1>
     
     <form method="post" action="/medicos">
         @csrf
                         
         <div class="mb-3">
             <label for="name" class="form-label">Nome:</label>
             <input type="text" id="name" name="name" class="form-control" required="">
         </div>
         
         <div class="mb-3">
             <label for="phone" class="form-label">Telefone:</label>
             <input type="text" id="phone" name="phone" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="crm" class="form-label">CRM:</label>
             <input type="text" id="crm" name="crm" class="form-control" required="">
         </div>
 
         <div class="mb-3">
             <label for="user_id" class="form-label">Usuário: </label>
                <select id="user_id" name="user_id" class="form-select" required>
                    @foreach ($users as $u)
                        @php
                            $medicoExistente = App\Models\Medico::where('user_id', $u->id)->first();
                            $disabled = $medicoExistente ? 'disabled' : '';
                            $selected = old('user_id') == $u->id ? 'selected' : '';
                        @endphp
                        
                        <option value="{{ $u->id }}" {{ $selected }} {{ $disabled }}>
                            {{ $u->email }}
                            @if($medicoExistente) (Já vinculado) @endif
                        </option>
                    @endforeach
                </select>
         </div>

         <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade:</label>
                <select id="especialidade" name="especialidade" class="form-select" required>
                    <option value="" selected disabled>Selecione uma especialidade</option>
                    <option value="Clínico Geral">Clínico Geral</option>
                    <option value="Pediatria">Pediatria</option>
                    <option value="Cardiologia">Cardiologia</option>
                    <option value="Dermatologia">Dermatologia</option>
                    <option value="Ortopedia">Ortopedia</option>
                    <option value="Ginecologia">Ginecologia</option>
                    <option value="Neurologia">Neurologia</option>
                    <option value="Oftalmologia">Oftalmologia</option>
                    <option value="Psiquiatria">Psiquiatria</option>
                    <option value="Outra">Outra</option>
                </select>
        </div>

         @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
        @endif
 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
@endsection