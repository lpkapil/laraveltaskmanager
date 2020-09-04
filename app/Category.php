<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'image'       
    ];

    public function products() 
    {
        return $this->hasMany('App\Product', 'product_category_id');
    }
}
