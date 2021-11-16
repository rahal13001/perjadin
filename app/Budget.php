<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'updated_at', 'deleted_at'];

    public function letter()
    {
        // return $this->belongsTo(Letter::class, 'budgets_id', 'id');
        // return $this->hasOne('Letter', 'budgets_id', 'id');
    }
}
