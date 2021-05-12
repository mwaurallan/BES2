<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    //
    protected $fillable = [
        'name_of_deceased',
        'name',
        'id_no',
        'home_area',
        'tel_no',
        'date_admitted',
        'permit_no',
        'relationship',
        'tel_no2',
    ];
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
