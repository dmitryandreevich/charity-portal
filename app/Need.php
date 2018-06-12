<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = ['status', 'id_org', 'type_need', 'title', 'cover', 'date_time',
        'description', 'link', 'file', 'amount', 'count_vols', 'cover_path', 'doc_path'];

    public function getCreatorEmail(){


        $creatorId = Organization::where('id', $this->id_org)->pluck('creator')->first();
        if( $creatorId ){
            $userEmail = User::where('id', $creatorId)->pluck('email')->first();
            if( $userEmail )
                return $userEmail;
        }
        return false;
    }
    public function getCreator(){
        $creatorId = Organization::where('id', $this->id_org)->pluck('creator')->first();
        if( $creatorId )
            return $creatorId;

        return false;
    }
    public function getParentOrganization(){
        $idOrg = $this->id_org;

        return Organization::find($idOrg);
    }
}
