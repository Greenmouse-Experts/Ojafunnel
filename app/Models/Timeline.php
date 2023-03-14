<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Library\Traits\HasUid;

class Timeline extends Model
{
    use HasUid;

    protected $fillable = ['automation2_id', 'subscriber_id', 'auto_trigger_id', 'activity', 'activity_type'];

    /**
     * Associations.
     *
     * @var object | collect
     */
    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber');
    }
}
