<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'responsable',
    ];

    public function user(){
        return $this->belongsTo("App\Models\User","user_id");
    }

    public function estado(){
        return $this->belongsTo(Estados::class);
    }

}
