<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function histroy()
    {
        return $this->belongsTo(Histroy::class);
    }
}
