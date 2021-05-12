<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $fillable = [
        'customer_name',
        'customer_email',
        'bill_total',
        'amount_paid',
        'bill_balance',

    ];
    //public function services()
  //  {
    //    return $this->belongsToMany(Service::class)->withPivot(['quantity']);
   // }
    public function services()
    {
//        return $this->belongsToMany('App\Service', ' bill_service',
//            'order_id', 'product_id')->withPivot(['quantity']);
//        return $this->hasMany('App\Bill_Service');
        return $this->hasMany('App\Bill_Service', 'order_id', 'id');
    }
    public function payments()
    {

        return $this->hasMany('App\Payment','order_id','id');
    }
//    public static function boot() {
//        parent::boot();
//        self::deleting(function($bill) { // before delete() method call this
//            $bill->services()->each(function($service) {
//                $service->delete(); // <-- direct deletion
//            });
//            $bill->payments()->each(function($payment) {
//                $payment->delete(); // <-- raise another deleting event on Post to delete comments
//            });
//            // do the rest of the cleanup...
//        });
//    }


}
