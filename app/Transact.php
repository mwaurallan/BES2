<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transact extends Model
{
    //
    protected $fillable = [
        'type',
        'trans_id',
        'trans_amount',
        'deleted_by',
    ];
}
