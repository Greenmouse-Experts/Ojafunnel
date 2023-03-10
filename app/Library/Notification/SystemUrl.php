<?php

/**
 * CronJobNotification class.
 *
 * Notification for cronjob issue
 *
 * LICENSE: This product includes software developed at
 * the App Co., Ltd. (http://Appmail.com/).
 *
 * @category   App Library
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

namespace App\Library\Notification;

use App\Models\Notification;

class SystemUrl extends Notification
{
    /**
     * Check if CronJob is recently executed and log a notification if not.
     */
    public static function check()
    {
        $title = trans('messages.admin.notification.system_url_title');
        self::cleanupDuplicateNotifications($title);

        $current = url('/');
        $cached = config('app.url');
        if ($current != $cached) {
            $warning = [
                'title' => $title,
                'message' => trans('messages.admin.notification.system_url_not_match', ['cached' => $cached, 'current' => $current]),
            ];

            self::warning($warning);
        }
    }
}
