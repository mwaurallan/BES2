<?php

namespace App\Models;
/* Imports */

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBranch extends Model
{

    protected $fillable = [
        'name',
        'description',
        'contact_email',
        'contact_person',
        'contact_phone',
        'active',
        'client_id',

    ];


    protected $casts = [
        'active' => 'boolean',

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute()
    {
        return route("api.client-branches.index");
    }

    public function getCanAttribute()
    {
        return [
            "view" => \Auth::check() ? \Auth::user()->can("view", $this) : false,
            "manage" => \Auth::check() ? \Auth::user()->can("manage", $this) : false,
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

    /* ************************ RELATIONS ************************ */
    /**
     * Many to One Relationship to \App\Models\Client::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, "client_id", "id");
    }
    public function customers() {
        return $this->hasMany(Customer::class, "client_branch_id");
    }
}
