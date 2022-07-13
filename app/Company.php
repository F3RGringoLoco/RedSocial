<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    public $primaryKey = 'com_id';

    protected $fillable = [
        'com_name', 'society', 'sector', 'property', 'location', 'description', 'bg_image', 'image',
    ];
}
