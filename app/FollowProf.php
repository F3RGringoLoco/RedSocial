<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowProf extends Model
{
    protected $table = 'follow_profs';

    protected $fillable = [
        'following_id',
    ];
}
