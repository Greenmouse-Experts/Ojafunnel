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

use App\Models\Setting;
use App\Models\Notification;

class CronJob extends Notification
{
    /**
     * Check if CronJob is recently executed and log a notification if not.
     */
    public static function check()
    {
        $title = trans('messages.admin.notification.cronjob_title');
        self::cleanupDuplicateNotifications($title);

        $interval = Setting::get('cronjob_min_interval');
        if (!self::isCronjobExecutedWithin($interval)) {
            $warning = [
                'title' => $title,
                'message' => trans('messages.admin.notification.cronjob_not_active', ['cronjob_min_interval' => "$interval", 'cronjob_last_executed' => self::getLastExecutionDateTime()]),
            ];

            self::warning($warning);
        }
    }

    /**
     * Check if CronJob is recently executed.
     *
     * @return bool
     */
    private static function isCronjobExecutedWithin($diff)
    {
        $timestamp = Setting::get('cronjob_last_execution');
        if (is_null($timestamp)) {
            return false;
        }

        $lastexec = \Carbon\Carbon::createFromTimestamp($timestamp);
        $checked = new \Carbon\Carbon(sprintf('%s ago', $diff));

        return $lastexec->gte($checked);
    }

    /**
     * Get last cron job executed date/time string.
     *
     * @return string
     */
    public static function getLastExecutionDateTime()
    {
        $timestamp = Setting::get('cronjob_last_execution');
        if (is_null($timestamp)) {
            return '#unknown';
        }

        return \Carbon\Carbon::createFromTimestamp($timestamp)->toDateTimeString();
    }
}
