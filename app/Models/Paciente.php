<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Agendamento;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'birth_date', 'address'];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}