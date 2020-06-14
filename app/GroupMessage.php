<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $fillable = [
        'from','roomID','message'
    ];

    protected $table = "groupmessage";
    public $timestamps = false;
}
