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
        return $this->belongsToMany(Sistema::class)->withPivot('inicio', 'fin');
    }

    public function cama()  //1 a1
    {
        return $this->hasOne(Cama::class);
    }

    public function users(){
        return $this->belongsToMany(User::class); // Muchos a muchos
    }
}