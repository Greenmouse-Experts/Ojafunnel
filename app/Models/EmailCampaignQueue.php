<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCampaignQueue extends Model
{
    use HasFactory;

    public function email_campaign()
    {
        return $this->belongsTo(EmailCampaign::class);
    }
}
