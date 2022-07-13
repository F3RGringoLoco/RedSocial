<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $table = 'posts';
    public $primaryKey = 'post_id';
    protected $guarded = [];

    protected $fillable = [
        'description', 'image',
    ];
}
