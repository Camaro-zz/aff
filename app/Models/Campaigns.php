<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model{
    protected $table = 'mt_campaigns';

    protected $guarded = ['camp_id'];

    public function hasManyLPs(){

        return $this->hasMany('App\Models\CampaignsLPs', 'camp_id', 'camp_id');

    }

}
