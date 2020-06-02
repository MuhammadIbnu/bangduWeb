<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bakuda extends Model
{
    //
    public $incrementing = false;

    protected $table= 'bakuda';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'username',
        'nama',
        'password',
        'api_token'
    ];
    protected $keytype = 'string';
}
