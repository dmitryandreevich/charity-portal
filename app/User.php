<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type', 'vkId', 'fbId','data','phone', 'city', 'vol_type_org','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function getData(User $user){
        return json_decode($user->data);
    }
    public function setEmailAttribute($value) {
        if ( empty($value) ) {
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }
    public function setVkIdAttribute($value) {
        if ( empty($value) ) {
            $this->attributes['vkId'] = NULL;
        } else {
            $this->attributes['vkId'] = $value;
        }
    }
    public function setFbIdAttribute($value) {
        if ( empty($value) ) {
            $this->attributes['fbId'] = NULL;
        } else {
            $this->attributes['fbId'] = $value;
        }
    }
    public static function getNeedsWithDonateByUser(User $user){
        $need_ids = HistoryOfDonate::where('id_sender', $user->id)->pluck('id_need')->toArray();
        $needs = Need::whereIn('id', $need_ids)->get();

        return $needs;
    }
    public static function getOrgsWithDonateByUser(User $user){
        $need_ids = HistoryOfDonate::where('id_sender', $user->id)->pluck('id_need')->toArray();
        $orgIds = Need::whereIn('id', $need_ids)->pluck('id_org')->toArray();

        $orgs = Organization::whereIn('id', $orgIds)->get();

        return $orgs;
    }
    public static function getAllConsumerNeeds(User $user){
        $orgIds = Organization::where('creator', $user->id)->pluck('id')->toArray();

        $needs = Need::whereIn('id_org', $orgIds)->get();

        return $needs;
    }
    public static function getAllNeedsWhereIsVolunteer(User $user){
        $volHistoriesIds = HistoryOfVolunteering::where('id_vol', $user->id)->pluck('id_need')->toArray();
        $needs = Need::whereIn('id', $volHistoriesIds)->get();

        return $needs;
    }
    public static function getAllOrgsWhereIsVolunteer(User $user){
        $volHistoriesIds = HistoryOfVolunteering::where('id_vol', $user->id)->pluck('id_org')->toArray();
        $orgs = Organization::whereIn('id', $volHistoriesIds)->get();

        return $orgs;
    }
}
