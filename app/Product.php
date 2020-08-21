<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'product_category_id',
        'product_name',
        'product_price',
        'product_qunatity',
        'product_qunatity_type',
        'product_status'      
    ];
}
