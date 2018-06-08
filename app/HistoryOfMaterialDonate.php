<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOfMaterialDonate extends Model
{
    protected $fillable = ['id_sender', 'id_need', 'info', 'id_org'];
}
