<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MediumUsers extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'medium_id', 'handle',];
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['is_admin'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function medium(){
        return $this->hasone('App\Media', 'id', 'medium_id');
    }
}
