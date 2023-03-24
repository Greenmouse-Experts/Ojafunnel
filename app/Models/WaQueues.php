<?php

namespace App\Models;

use App\Models\WaCampaigns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaQueues extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wa_campaign_id',
        'phone_number',
        'status'
    ];

    public function wa_campaign()
    {
        return $this->belongsTo(WaCampaigns::class);
    }
}
