<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table = 'profesionals';

    protected $fillable = [
        'name', 'birth', 'phone', 'career', 'user_id',
    ];
}
