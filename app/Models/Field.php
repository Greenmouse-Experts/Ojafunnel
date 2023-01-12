<?php

/**
 * Field class.
 *
 * Model class for List's custom fields
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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Library\Traits\HasUid;

class Field extends Model
{
    use HasUid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_list_id',
        'type',
        'label',
        'tag',
        'default_value',
        'visible',
        'required',
    ];

    /**
     * Associations.
     *
     * @var object | collect
     */
    public function mailList()
    {
        return $this->belongsTo('App\Models\MailList');
    }

    public function fieldOptions()
    {
        return $this->hasMany('App\Models\FieldOption');
    }

    /**
     * Format string to field tag.
     *
     * @var string
     */
    public static function formatTag($string)
    {
        return strtoupper(preg_replace('/[^0-9a-zA-Z_]/m', '', $string));
    }

    /**
     * Get select options.
     *
     * @return array
     */
    public function getSelectOptions()
    {
        $options = $this->fieldOptions->map(function ($item) {
            return ['value' => $item->value, 'text' => $item->label];
        });

        return $options;
    }

    /**
     * Get control name.
     *
     * @return array
     */
    public static function getControlNameByType($type)
    {
        if ($type == 'date') {
            return 'date';
        } elseif ($type == 'number') {
            return 'number';
        } elseif ($type == 'datetime') {
            return 'datetime';
        }

        return 'text';
    }
}
