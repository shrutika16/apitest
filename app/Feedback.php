<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $guarded = [];

    protected $fillable = [
        'post_id', 'user_id',
    ];
}
