<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SmsQueueStatus extends Enum
{
    const WAITING = 'Waiting';
    const SENT = 'Sent';
    const CANCELLED = 'Cancelled';
}
