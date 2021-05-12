<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseUpdate extends Model
{
//    use HasFactory;

    protected $fillable = [
        'case_file_id',
        'previous_status_id',
        'new_status_id',
        'case_note_id',
        'next_action_id',
        'payment_promise_id',
        'updater_id',
        'call_status_id',

    ];



    protected $dates = [
            'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.case-updates.index");
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
    * Many to One Relationship to \App\Models\CallStatus::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function callStatus() {
        return $this->belongsTo(\App\Models\CallStatus::class,"call_status_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\CaseFile::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function caseFile() {
        return $this->belongsTo(\App\Models\CaseFile::class,"case_file_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\CaseNote::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function caseNote() {
        return $this->belongsTo(\App\Models\CaseNote::class,"case_note_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\CaseFileStatus::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function newStatus() {
        return $this->belongsTo(\App\Models\CaseFileStatus::class,"new_status_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\ScheduledAction::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function nextAction() {
        return $this->belongsTo(\App\Models\ScheduledAction::class,"next_action_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\PaymentPromise::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function paymentPromise() {
        return $this->belongsTo(\App\Models\PaymentPromise::class,"payment_promise_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\CaseFileStatus::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function previousStatus() {
        return $this->belongsTo(\App\Models\CaseFileStatus::class,"previous_status_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\User::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function updater() {
        return $this->belongsTo(\App\Models\User::class,"updater_id","id");
    }
}
