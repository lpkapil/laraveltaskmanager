<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id',
        'store_name',
        'store_logo',
        'store_description',
        'store_address'    
    ];
}
