<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactNumber extends Model
{
    use HasFactory;

    public function contactList()
    {
        return $this->belongsTo(ContactList::class, 'contact_list_id');
    }
}
