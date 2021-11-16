<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    // use SoftDeletes;
    // protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $table = 'employes';
}
