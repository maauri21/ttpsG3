<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }

    public function evoluciones()
    {
        return $this->hasMany(Evolucion::class);
    }

    public function sistemas(){
        return $this->belongsToMany(Sistema::class)->withPivot('fecha', 'fin');
    }

}
