<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
    ];
    public function bills()
    {
        return $this->belongsToMany('App\Bill', ' bill_service',
            'order_id', 'product_id')->withPivot(['quantity']);
    }

}
