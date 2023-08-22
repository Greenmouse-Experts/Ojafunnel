<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Dotlogics\Grapesjs\App\Contracts\Editable;
use App\Models\User;
use App\Models\OjaPlanParameter;
use App\Models\OjaSubsciption;

class Page extends Model implements Editable
{
    use HasFactory;
    use EditableTrait;

    protected $guarded = [];

    public static function isParemeterCheck($user_id) {
        $user = User::find($user_id);
        if($user->type == "Administrator")
        {
            return true;
        }

        $subscription = OjaSubscription::where(['user_id' => $user->id, 'status' => 'Active'])
            ->first();
        if( is_null($subscription) )
        {
            return false;
        }

        $parameter = OjaPlanParameter::where(['plan_id' => $subscription->plan_id])->first();
        $pagerecords = self::where(['user' => $user->id])->get();
        $pgs = (int) $parameter->page_builder;


        if( sizeof($pagerecords) > $pgs) {
            return false;
        }

        return true;
    }
}
