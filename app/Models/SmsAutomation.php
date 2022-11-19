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
        'senders_name',
        'message',
        'contacts',
        'optout_message',
        'message_timimg',
        'schedule_date',
        'schedule_time',
        'integration_id',
        'status'
    ];
}