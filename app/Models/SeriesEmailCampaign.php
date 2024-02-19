<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesEmailCampaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo(EmailCampaign::class, 'email_campaign_id', 'id');
    }
}
