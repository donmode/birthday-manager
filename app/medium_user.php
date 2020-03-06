<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medium_user extends Model
{
        protected $fillable = ['user_id', 'medium_id', 'handle',];
}
