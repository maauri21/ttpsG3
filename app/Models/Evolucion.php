<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucion extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function internacion(){
        return $this->belongsTo(Internacion::class); // 1 a muchos
    }
}
