<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function sistema(){
        return $this->belongsTo(Sistema::class);
    }

    public function camas()
    {
        return $this->hasMany(Cama::class);
    }
}