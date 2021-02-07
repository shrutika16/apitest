<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $table = 'subscription';
    protected $guarded = [];

    protected $fillable = [
        'from_user_id', 'to_user_id',
    ];
}
