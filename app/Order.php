<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $fillable = [
        'store_id',
        'user_id',
        'status',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_pincode',
        'customer_city',
        'payment_method',
        'items_count',
        'subtotal',
        'delivery_charge',
        'grand_total'
    ];

    public function items() 
    {
        return $this->hasMany('App\OrderItem', 'order_id');
    }

    
}
