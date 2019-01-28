<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = ['nome', 'quantita', 'datadiscadenza'];

    protected $attributes = ['datadiscadenza' => '1970-01-01'];

}
