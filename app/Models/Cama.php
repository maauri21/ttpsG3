<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cama extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function sala(){
        return $this->belongsTo(Sala::class);
    }

    public function paciente(){
        return $this->hasOne(Paciente::class);      // 1 a 1
    }
}

//  $cama->paciente = $Modelo del paciente;

// $cama->paciente()->save($ModeloPaciente);