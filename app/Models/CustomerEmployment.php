<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerEmployment extends Model
{

    protected $fillable = [
        'postal_address',
        'employer',
        'postal_code',
        'town',
        'phone_number',
        'email',
        'contact_person_details',
        'physical_address',
        'to_date',
        'from_date',
        'still_employed_here',
        'customer_id',

    ];


    protected $casts = [
        'still_employed_here' => 'boolean',

    ];

    protected $dates = [
        'to_date' => 'Y-m-d',
        'from_date' => 'Y-m-d',
            'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.customer-employments.index");
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
