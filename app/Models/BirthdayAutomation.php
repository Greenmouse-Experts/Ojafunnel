<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BirthdayAutomation extends Model
{
    use HasFactory;

    protected function automation(): Attribute
    {
        return Attribute::make(
        get: fn($value) => json_decode($value, true),
        set: fn($value) => json_encode($value),
        );
    }

    public function readAutomation($key, $default = null)
    {
        $cache = json_decode($this->cache, true);
        if (is_null($cache)) {
            return $default;
        }
        if (array_key_exists($key, $cache)) {
            if (is_null($cache[$key])) {
                return $default;
            } else {
                return $cache[$key];
            }
        } else {
            return $default;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
