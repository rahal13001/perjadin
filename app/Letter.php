<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function budget()
    {
        // return $this->hasOne(Budget::class, 'budgets_id', 'id');
        return $this->belongsTo('App\Budget', 'budgets_id');
    }

    public function participant()
    {
        return $this->hasOne('App\Participant', 'letters_id')
            ->belongsTo('App\Employes', 'employes_id');
    }

    // public function employes()
    // {
    //     return $this->belongsTo('App\Employes', 'employes_id');
    // }
}
