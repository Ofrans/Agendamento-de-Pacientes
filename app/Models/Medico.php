<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Agendamento; 


class Medico extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'name', 'phone', 'crm'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
