<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OjaSubscription extends Model
{
    use HasFactory;

    // protected $guarded = [];

    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'amount',
        'currency',
        'current_period_ends_at',
        'canceled_immediately',
        'expiry_notify_at',
        'ends_at',
        'started_at',
        'extended',
        'renewed',
        'subscription_reminder',
    ];
}
