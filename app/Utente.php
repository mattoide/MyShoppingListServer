<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{

    public function lista() {
        return $this->hasMany('App\Lista');
    }

    public function condiviso() {
        return $this->hasMany('App\CondivisioniUtenti');
    }
    protected $fillable = ['nickname', 'password'];
    protected $hidden = ['password'];
}
