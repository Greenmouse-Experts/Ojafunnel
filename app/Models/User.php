<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type',
        'affiliate_link',
        'code',
        'photo',
        'first_name',
        'last_name',
        'username',
        'email',
        'phone_number',
        'referral_link',
        'plan',
        'wallet',
        'ref_bonus',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public static function planName($id)
    {
        $plan = \App\Models\Plan::where('id', $id)->first();
        return $plan->name;
    }


    public function store()
    {
        return $this->hasMany('App\Models\Store');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction');
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setActivated()
    {
        $this->activated = 'active';
        $this->save();
    }

    public function registerRules()
    {
        $rules = array(
            'email' => 'required|email|unique:users,email,' . $this->id . ',id',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'min:5', 'max:100', 'regex:/^\S*$/u', 'unique:users'],
            'phone_number' => ['required', 'numeric'],
            'timezone' => 'required',
            'language_id' => 'required',
        );

        if (isset($this->id)) {
            $rules['password'] = 'min:5';
        } else {
            $rules['password'] = 'required|min:5';
        }

        return $rules;
    }

    public function chats ()
    {
        return $this->hasMany(Chat::class);
    }

}
