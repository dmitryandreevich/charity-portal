<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['id_need', 'id_sender', 'message'];
}
