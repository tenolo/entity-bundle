<?php

namespace Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\TimeType;

/**
 * Class TimeUTCType
 *
 * @package Tenolo\Bundle\EntityBundle\Doctrine\DBAL\Types
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class TimeUTCType extends TimeType
{

    const TIMEUTC = 'timeutc';

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::TIMEUTC;
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return ($value !== null) ?
            $value->setTimezone(new \DateTimeZone('UTC'))->format($platform->getDateTimeFormatString()) : null;
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof \DateTime) {
            return $value;
        }

        $dateTime = \DateTime::createFromFormat('!' . $platform->getTimeFormatString(), $value, new \DateTimeZone('UTC'));

        if (!$dateTime) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getTimeFormatString());
        }

        if ($dateTime instanceof \DateTime) {
            $dateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }

        return $dateTime;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
