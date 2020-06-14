<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendlist extends Model
{
    protected $fillable = [
        'userID' , 'friendID'
    ];

    protected $table = "friendlist";
}
