<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
        // Indicando cual es la foreign key
        // return $this->belongsTo(User::class, 'user_id')->select(['name','username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
        // Indicando cual es la foreign key
        // return $this->belongsTo(User::class, 'user_id')->select(['name','username']);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        // Usa la relacion previamente creada y verifica que en la columna user_id no se encuentre el usuario colocado
        return $this->likes->contains('user_id', $user->id);
    }
}
