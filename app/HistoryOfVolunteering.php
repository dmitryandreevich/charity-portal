<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOfVolunteering extends Model
{
    protected $fillable = ['id_vol', 'amount', 'id_need', 'id_org'];
}
