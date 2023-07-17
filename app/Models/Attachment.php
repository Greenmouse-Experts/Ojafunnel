<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Library\Traits\HasUid;

class Attachment extends Model
{
    use HasUid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'size',
    ];

    /**
     * Association with mailList through mail_list_id column.
     */
    public function email()
    {
        return $this->belongsTo('App\Models\Email');
    }

    /**
     * Remove attachment.
     *
     * @return object
     */
    public function remove()
    {
        unlink($this->file);
        $this->delete();
    }
}
