<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Library\Traits\HasUid;

class EmailLink extends Model
{
    use HasUid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link',
    ];

    /**
     * Association with mailList through mail_list_id column.
     */
    public function email()
    {
        return $this->belongsTo('App\Models\Email');
    }
}
