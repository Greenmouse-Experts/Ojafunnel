<?php

namespace App\Models;

use App\Models\WaQueues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaCampaigns extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'whatsapp_account',
        'user_id',
        'receivers',
        'template',
        'template1_message',
        'template2_message',
        'template2_file',
        'template3_header',
        'template3_message',
        'template3_footer',
        'template3_link_url',
        'template3_link_cta',
        'template3_phone_number',
        'template3_phone_cta',
        'message_timing',
    ];

    public function wa_queues()
    {
        return $this->hasMany(WaQueues::class, 'wa_campaign_id');
    }
}
