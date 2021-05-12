<?php

namespace App\Models;
/* Imports */

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends \Spatie\Permission\Models\Permission
{

    protected $fillable = [
        'name',
        'title',
        'guard_name',

    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute()
    {
        return route("api.permissions.index");
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

    public function getGroupAttribute() {
        $explode = explode('.',$this->name);
        if (count($explode)) {
            $group = Str::title(str_replace("-"," ", $explode[0]));
        } else {
            $group = "Others";
        }
        return $group;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /* ************************ RELATIONS ************************ */
}
