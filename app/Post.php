<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = [];

    protected $fillable = [
        'Content', 'user_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'foreign_key', 'owner_key');
    // }
}
