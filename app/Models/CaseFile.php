<?php

namespace App\Models;
/* Imports */

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseFile extends Model
{
//    use HasFactory;

    protected $fillable = [
        'loan_account_number',
        'priority_id',
        'debt_type_id',
        'debt_category_id',
        'product_type_id',
        'principal',
        'creator_id',
        'paybill_number',
        'officer_id',
        'customer_id',
        'client_branch_id',
        'client_id',
        'interest',
        'overdraft',
        'batch_number',
        'status_id',
        'loan_amount',
    ];


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $appends = ["api_route", "can", "descriptive_name", "status_name"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute()
    {
        return route("api.case-files.index");
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

    public function getDescriptiveNameAttribute()
    {
        return $this->id . " - " . $this->customer->full_name;
    }

    public function getStatusNameAttribute()
    {
        return $this->status ? $this->status->name : '';
    }

    public function getPaidAmountAttribute() {
        return floatval($this->payments()->sum("amount"));
    }
    public function getLoanBalanceAttribute() {
        return $this->loan_amount - $this->paid_amount;
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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
     * Many to One Relationship to \App\Models\User::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, "creator_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\Customer::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, "customer_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\DebtCategory::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function debtCategory()
    {
        return $this->belongsTo(\App\Models\DebtCategory::class, "debt_category_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\DebtType::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function debtType()
    {
        return $this->belongsTo(\App\Models\DebtType::class, "debt_type_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\User::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function officer()
    {
        return $this->belongsTo(\App\Models\User::class, "officer_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\Priority::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(\App\Models\Priority::class, "priority_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\ProductType::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo(\App\Models\ProductType::class, "product_type_id", "id");
    }

    /**
     * Many to One Relationship to \App\Models\CaseFileStatus::class
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(\App\Models\CaseFileStatus::class, "status_id", "id");
    }

    public function caseUpdates()
    {
        return $this->hasMany(CaseUpdate::class, "case_file_id");
    }

    public function caseNotes()
    {
        return $this->hasMany(CaseNote::class, "case_file_id");
    }

    public function scheduledActions()
    {
        return $this->hasMany(ScheduledAction::class, "case_file_id");
    }
    public function payments() {
        return $this->hasMany(CasePayment::class, "case_file_id");
    }
}
