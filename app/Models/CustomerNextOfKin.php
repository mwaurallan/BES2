<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNextOfKin extends Model
{

    protected $table = "customer_next_of_kins";
    protected $fillable = [
        'name',
        'details',
        'email',
        'phone_number',
        'postal_address',
        'town',
        'physical_address',
        'customer_id',

    ];



    protected $dates = [
            'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.customer-next-of-kins.index");
    }
    public function getCanAttribute() {
        return [
            "view" => \Auth::check() ? \Auth::user()->can("view", $this) : false,
            "update" => \Auth::check() ? \Auth::user()->can("update", $this) : false,
            "delete" => \Auth::check() ? \Auth::user()->can("delete", $this) : false,
            "restore" => \Auth::check() ? \Auth::user()->can("restore", $this) : false,
            "forceDelete" => \Auth::check() ? \Auth::user()->can("forceDelete", $this) : false,
        ];
    }

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    /* ************************ RELATIONS ************************ */
    /**
    * Many to One Relationship to \App\Models\Customer::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function customer() {
        return $this->belongsTo(\App\Models\Customer::class,"customer_id","id");
    }
}
