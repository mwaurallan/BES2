<?php

namespace App\Models;
/* Imports */

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_date',
        'resolved_at',
        'case_file_id',
        'action_type_id',
        'scheduler_id',

    ];


    protected $dates = [
        'scheduled_date',
        'resolved_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute()
    {
        return route("api.scheduled-actions.index");
    }

    public function getCanAttribute()
    {
        return [
            "view" => \Auth::check() ? \Auth::user()->can("view", $this) : false,
            "update" => \Auth::check() ? \Auth::user()->can("update", $this) : false,
            "delete" => \Auth::check() ? \Auth::user()->can("delete", $this) : false,
            "restore" => \Auth::check() ? \Auth::user()->can("restore", $this) : false,
            "forceDelete" => \Auth::check() ? \Auth::user()->can("forceDelete", $this) : false,
            "resolve" => \Auth::check() ? \Auth::user()->can("resolve", $this) : false,
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /* ************************ RELATIONS ************************ */
    /**
     * Many to One Relationship to \App\Models\ActionType::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actionType()
    {
        return $this->belongsTo(\App\Models\ActionType::class, "action_type_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\CaseFile::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function caseFile()
    {
        return $this->belongsTo(\App\Models\CaseFile::class, "case_file_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\User::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scheduler()
    {
        return $this->belongsTo(\App\Models\User::class, "scheduler_id", "id");
    }
}
