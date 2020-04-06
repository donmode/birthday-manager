<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['name', 'url', 'logo_url',];

    public function media_user()
    {
        return $this->hasMany('App\MediumUsers');
    }
}
