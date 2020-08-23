<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $fillable = [
        'user_id',
        'name',
        'slug'       
    ];

    public function products() 
    {
        return $this->hasMany('App\Product', 'id');
    }
}
