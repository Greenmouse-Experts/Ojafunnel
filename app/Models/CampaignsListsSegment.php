<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignsListsSegment extends Model
{
    /**
     * Associations.
     *
     * @var object | collect
     */
    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign');
    }

    public function mailList()
    {
        return $this->belongsTo('App\Models\MailList');
    }

    public function segment()
    {
        return $this->belongsTo('App\Models\Segment');
    }
}
