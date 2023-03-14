<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionsEmailVerificationServer extends Model
{
    public function emailVerificationServer()
    {
        return $this->belongsTo('App\Models\EmailVerificationServer', 'server_id');
    }
}
