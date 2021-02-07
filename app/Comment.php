<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    protected $fillable = [
        'post_id', 'comment', 'user_id',
    ];
}
