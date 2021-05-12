<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCounty extends Model
{
    //
    //use SoftDeletes;
    protected $table = 'sub_counties';
    protected $fillable = ['name'];
}
