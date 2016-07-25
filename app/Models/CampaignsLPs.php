<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignsLPs extends Model
{
    protected $table = 'mt_landing_pages';

    protected $guarded = ['lp_id'];

    public function camp() {
        return $this->belongsTo('App\Models\Campaigns', 'camp_id', 'camp_id');
    }
}
