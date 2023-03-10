<?php

/**
 * UserActivation class.
 *
 * Model class for user activation
 *
 * LICENSE: This product includes software developed at
 * the App Co., Ltd. (http://Appmail.com/).
 *
 * @category   MVC Model
 *
 * @author     N. Pham <n.pham@Appmail.com>
 * @author     L. Pham <l.pham@Appmail.com>
 * @copyright  App Co., Ltd
 * @license    App Co., Ltd
 *
 * @version    1.0
 *
 * @link       http://Appmail.com
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserActivation extends Model
{
    /**
     * Get user activation token.
     *
     * @return string
     */
    public static function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * User.
     *
     * @return string
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
