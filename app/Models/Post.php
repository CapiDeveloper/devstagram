<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class)->select(['name','username','imagen']);
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function checkLike(User $user){
        // $this->likes: utilizaremos la relacion likes, que se definio en la funcion likes(),
        // esto significa que estamos accediendo a la coleccion de likes asociados con este post
        // en particular, por lo tanto me devuelve una coleccion (array similar) de los registros
        // de la tabla likes que estan asociados a este post en particular
        return $this->likes->contains('user_id',$user->id);
    }
}
