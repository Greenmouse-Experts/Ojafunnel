<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MailList extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the contacts subscribed to this list.
     *
     * @return BelongsToMany<Contact>
     */
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }

}
