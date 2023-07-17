<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsQueue extends Model
{
    use HasFactory;

    /**
     * Disable timestamps for this model (as we don't have created_at/updated_at fields)
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fields that will be allowed for mass assignment
     *
     * @var array
     */
    protected $fillable = ['sms_campaign_id', 'phone_number', 'status'];

    /**
     * Relation to sms campaign model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo(SmsCampaign::class);
    }
}
