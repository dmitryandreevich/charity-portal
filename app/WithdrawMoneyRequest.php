<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawMoneyRequest extends Model
{
    protected $fillable = ['id_need', 'id_org', 'is_paid', 'id_sender', 'amount'];
}
