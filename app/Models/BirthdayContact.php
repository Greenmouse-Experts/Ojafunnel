<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthdayContact extends Model
{
    use HasFactory;

    public function birthdayList()
    {
        return $this->belongsTo(BirthdayContactList::class, 'birthday_contact_list_id');
    }
}
