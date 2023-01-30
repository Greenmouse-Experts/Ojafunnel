<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SmsCampaignStatus extends Enum
{
    const ACTIVE = 'Active';

    const STOPPED = 'Stopped';

    const SENT = 'Sent';

    const PAUSED = 'Paused';
}
