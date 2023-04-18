<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MailContact extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the lists that this contact is subscribed to.
     *
     * @return BelongsToMany<MailList>
     */
    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(MailList::class)->withTimestamps();
    }

    /**
     * Unsubscribe a contact in the system.
     */
    public function markSubscribed(): void
    {
        $this->update(['subscribe' => false]);
        $this->lists()->detach();
    }

    /**
     * Delete this contact along with any relations.
     */
    public function deleteWithRelations(): void
    {
        $this->lists()->detach();
        $this->delete();
    }
}