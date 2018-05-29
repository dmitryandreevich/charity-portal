<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = ['status', 'id_org', 'type_need', 'title', 'cover', 'date_time',
        'description', 'link', 'file', 'amount', 'count_vols', 'cover_path', 'doc_path'];

    public function addMember($id, $amount){
        $members = json_decode($this->members);

    }
}
