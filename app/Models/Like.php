<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

//Obtener los comentarios de una publicacion
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

//Obtener los likes
    public function likes(){
        return $this->hasMany(Like::class);

        
    } 
}
