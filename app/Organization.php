<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['address', 'name', 'status', 'files_path', 'description', 'type_consumer', 'city', 'creator','cover_path', 'doc_path'];
}
