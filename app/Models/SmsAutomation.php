<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsAutomation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'mailinglist_id',
        'integration_id',
        'sms_sent',
        'delivered',
        'not_delivered',
        'opens',
        'unsubscribed',
        'campaign_name',
        'senders_name',
        'message',
        'contacts',
        'optout_message',
        'message_timimg',
        'schedule_date',
        'schedule_time',
        'status'
    ];
}