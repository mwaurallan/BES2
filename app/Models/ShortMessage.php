<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_response',
        'sent_at',
        'recipients',
        'message',
        'successful',
        'creator_id',

    ];


    protected $casts = [
        'successful' => 'boolean',

    ];

    protected $dates = [
            'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can", "is_draft"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.short-messages.index");
    }
    public function getIsDraftAttribute() {
        return !$this->sent_at;
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
    * Many to One Relationship to \App\Models\User::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function creator() {
        return $this->belongsTo(\App\Models\User::class,"creator_id","id");
    }
}
