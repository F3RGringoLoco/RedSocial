<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    public $primaryKey = 'br_id';

    protected $fillable = [
        'pro_name', 'description'
    ];
}
