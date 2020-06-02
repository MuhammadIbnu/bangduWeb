<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    protected $guarded=[];
    protected $primaryKey='kd_berkas';

    public function waris()
    {
        return $this->belongsTo('App\Waris', 'kd_waris', 'id');
    }
}

