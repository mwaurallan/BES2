<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_ref',
        'comments',
        'amount',
        'paid_at',
        'case_file_id',
        'creator_id',
        'payment_mode_id',
    
    ];
    
    
    
    protected $dates = [
            'paid_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.case-payments.index");
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
    * Many to One Relationship to \App\Models\User::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function creator() {
        return $this->belongsTo(\App\Models\User::class,"creator_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\PaymentMode::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function paymentMode() {
        return $this->belongsTo(\App\Models\PaymentMode::class,"payment_mode_id","id");
    }
}
