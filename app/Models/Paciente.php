<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    public function contacto(){
        return $this->belongsTo(Contacto::class); // 1 a muchos
    }

    public function sistemas(){
        return $this->belongsToMany(Sistema::class); // Muchos a muchos
    }
}