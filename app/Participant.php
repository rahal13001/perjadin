<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];


    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    // public function letter()
    // {
    //     return $this->belongsTo('App\Letter', 'letters_id');
}
