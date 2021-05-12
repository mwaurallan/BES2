<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    //
    protected $fillable = [
        'name_of_deceased',
        'adm_no',
        'next_of_kin',
        'id_no',
        'permit_no',
        'county',
        'subcounty',
        'location',
        'village',
        'nearest_centre',
        'nearest_police',
        'witness',
        'witness_id',
        'auth_officer',
        'release_officer',
        'release_date',
    ];
}
