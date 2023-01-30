<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    /**
     * The name of the "updated at" column. We just make it not usable by Laravel
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * Fields that will be allowed for mass assignment
     *
     * @var array
     */
    protected $fillable = ['sms_queue_id', 'message', 'status'];
}
