<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryOfDonate extends Model
{
    protected $fillable = ['id_need', 'id_sender', 'amount'];
}
