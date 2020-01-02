<?php

namespace iArcadia\Time;

use iArcadia\Time\Traits\TimeComparison;
use iArcadia\Time\Traits\TimeFormatter;
use iArcadia\Time\Traits\TimeGetters;
use iArcadia\Time\Traits\TimeOperation;
use iArcadia\Time\Traits\TimeSetters;

/**
 * Class Time
 * @package iArcadia
 */
class Time
{
    use TimeGetters, TimeSetters, TimeOperation, TimeComparison, TimeFormatter;

    /** @var string - Default format. */
    static protected $default_format = '-h\h iim ss\s vvv';

    /** @var float - Total timestamp. */
    protected $timestamp = 0.0;

    /**
     * Time constructor.
     * @constructor
     * @param Time|int|float ...$args
     */
    public function __construct(...$args)
    {
        $this->add(...$args);
    }

    /**
     * Call a fake attribute execute its getter if existing.
     * @param string $attribute
     * @return mixed
     */
    public function __get(string $attribute)
    {
        $getter = 'get' . ucfirst(preg_replace_callback('/_[a-zA-Z0-9]/', function ($matches) {
                $str = '';

                foreach ($matches as $match) {
                    $str .= ucfirst(str_replace('_', '', $match));
                }

                return $str;
            }, $attribute));

        if (!method_exists($this, $getter)) {
            return null;
        }

        return $this->$getter();
    }

    /**
     * Set a fake attribute execute its setter if existing.
     * @param string $attribute
     * @param mixed $value
     * @return $this
     */
    public function __set(string $attribute, $value): self
    {
        $setter = 'set' . ucfirst(preg_replace_callback('/_[a-zA-Z0-9]/', function ($matches) {
                $str = '';

                foreach ($matches as $match) {
                    $str .= ucfirst(str_replace('_', '', $match));
                }

                return $str;
            }, $attribute));

        if (!method_exists($this, $setter)) {
            return null;
        }

        return $this->$setter($value);
    }

    /**
     * This method defines how the instance have to react when treated as a string.
     * @return string
     */
    public function __toString()
    {
        return $this->format();
    }

    /**
     * Check if the time is negative.
     * @return bool
     */
    public function isNegative(): bool
    {
        return $this->getTimestamp() < 0;
    }

    /**
     * Transform the instance into a DateTime one.
     * @return \DateTime
     * @throws \Exception
     */
    public function toDateTime(): \DateTime
    {
        return new \DateTime($this->getTimestamp());
    }

    /**
     * Transform the instance into a DateInterval one.
     * @return \DateInterval
     * @throws \Exception
     */
    public function toDateInterval(): \DateInterval
    {
        return new \DateInterval('PT' . (int)$this->getTotalSeconds() . 'S');
    }

    /**
     * Build a Time instance.
     * @static
     * @param Time|int|float ...$args
     * @return Time
     */
    public static function create(...$args): Time
    {
        return new Time(...$args);
    }

    /**
     * Build a Time instance from a native Date instance.
     * @param \DateTime|\DateInterval $date
     * @return Time
     */
    public static function createFromDate($date): Time
    {
        switch (get_class($date)) {
            case \DateTime::class:
                return Time::createFromDateTime($date);

            case \DateInterval::class:
                return Time::createFromDateInterval($date);
        }

        return Time::create();
    }

    /**
     * Build a Time instance from a DateTime one.
     * @static
     * @param \DateTime $dt
     * @return Time
     */
    public static function createFromDateTime(\DateTime $dt): Time
    {
        return Time::create($dt->getTimestamp() * 1000);
    }

    /**
     * Build a Time instance from a DateInterval one.
     * @param \DateInterval $interval
     * @return Time
     */
    public static function createFromDateInterval(\DateInterval $interval): Time
    {
        return Time::create($interval->h, $interval->i, $interval->s, 0);
    }
}