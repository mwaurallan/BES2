<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'profile_photo_path',
        'email_verified_at',
        'current_team_id',

    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $dates = [
            'email_verified_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can",'profile_photo_url',];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.users.index");
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
    public function caseFiles() {
        return $this->hasMany(CaseFile::class, "officer_id");
    }
    public function createdEvents() {
        return $this->hasMany(ScheduledAction::class,"scheduler_id");
    }
    public function scheduledEvents() {
        return  $this->hasManyThrough(ScheduledAction::class,CaseFile::class,"officer_id","case_file_id");
    }
}
