<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manage_util extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'id', 'histroy_id'
    ];

}
