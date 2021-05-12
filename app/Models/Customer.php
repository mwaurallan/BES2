<?php

namespace App\Models;
/* Imports */

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'passport_number',
        'id_number',
        'kra_pin',
        'driving_license',
        'town',
        'nearby_major_town',
        'more_information',
        'county_id',
        'client_id',
        'client_branch_id',

    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can", "full_name"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute()
    {
        return route("api.customers.index");
    }

    public function getCanAttribute()
    {
        return [
            "view" => \Auth::check() ? \Auth::user()->can("view", $this) : false,
            "update" => \Auth::check() ? \Auth::user()->can("update", $this) : false,
            "delete" => \Auth::check() ? \Auth::user()->can("delete", $this) : false,
            "restore" => \Auth::check() ? \Auth::user()->can("restore", $this) : false,
            "forceDelete" => \Auth::check() ? \Auth::user()->can("forceDelete", $this) : false,
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected function getFullNameAttribute() {
        return join(" ", [$this->first_name, $this->middle_name, $this->last_name]);
    }
    /* ************************ RELATIONS ************************ */
    /**
     * Many to One Relationship to \App\Models\ClientBranch::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientBranch()
    {
        return $this->belongsTo(\App\Models\ClientBranch::class, "client_branch_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\Client::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, "client_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\County::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function county()
    {
        return $this->belongsTo(\App\Models\County::class, "county_id", "id");
    }

    public function phones() {
        return $this->hasMany(CustomerPhone::class,"customer_id");
    }
    public function emails() {
        return $this->hasMany(CustomerEmail::class,"customer_id");
    }
    public function caseFiles() {
        return $this->hasMany(CaseFile::class, "customer_id");
    }
}
