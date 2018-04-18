<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable=[
        'firstName','lastName','image','job','status','point',
    ];
    
    Public function User()
    {
        return $this->belongsTo(User::class);
    }
}
