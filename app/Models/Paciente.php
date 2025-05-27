<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Agendamento;
use App\Models\Medico;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'birth_date', 'address', 'medico_id'];

    public function medico() {
        return $this->belongsTo(Medico::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}