<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'product_image',
        'product_category_id',
        'product_name',
        'product_mrp',
        'product_price',
        'product_quantity',
        'product_quantity_type',
        'product_status',
        'product_description'
    ];

    public function category()
    {
        return $this->hasOne('App\Category', 'product_category_id');
    }
    
}
