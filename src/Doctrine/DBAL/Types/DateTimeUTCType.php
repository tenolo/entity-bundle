<?php

namespace Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class DateTimeUTCType
 *
 * @package Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class DateTimeUTCType extends \ASM\Doctrine\DBAL\Types\DateTimeUTCType
{

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        /** @var DateTime $dateTime */
        $dateTime = parent::convertToPHPValue($value, $platform);

        if ($dateTime instanceof DateTime) {
            $dateTime = Carbon::parse($dateTime->format('r'));
            $dateTime->setTimezone(new DateTimeZone(date_default_timezone_get()));
        }

        return $dateTime;
    }
}
