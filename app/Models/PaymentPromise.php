<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPromise extends Model
{
//    use HasFactory;

    protected $fillable = [
        'promised_amount',
        'promised_payment_date',
        'resolved_at',
        'case_file_id',
        'case_note_id',
        'case_payment_id',
        'creator_id',

    ];



    protected $dates = [
        'promised_payment_date' => 'Y-m-d',
            'resolved_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.payment-promises.index");
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
    * Many to One Relationship to \App\Models\CasePayment::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function casePayment() {
        return $this->belongsTo(\App\Models\CasePayment::class,"case_payment_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\User::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function creator() {
        return $this->belongsTo(\App\Models\User::class,"creator_id","id");
    }
}
