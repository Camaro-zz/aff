<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignsOffers extends Model
{
    protected $table = 'mt_offers';

    protected $guarded = ['offer_id'];
}
