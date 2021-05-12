<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_Service extends Model
{
    //

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];
}
