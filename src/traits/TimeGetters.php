<?php

namespace iArcadia\Time\Traits;

/**
 * Trait TimeGetters
 * @package iArcadia\Time\Traits
 */
trait TimeGetters
{
    /**
     * Get total timestamp.
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    /**
     * Get the total of milliseconds.
     * @return float
     */
    public function getTotalMilliseconds(): float
    {
        return $this->getTimestamp();
    }

    /**
     * Get the milliseconds.
     * @return int
     */
    public function getMilliseconds(): int
    {
        return $this->getTotalMilliseconds() % 1000;
    }

    /**
     * Get the total of hundredth of seconds.
     * @return float
     */
    public function getTotalHundredthOfSeconds(): float
    {
        return $this->getTotalMilliseconds() / 10;
    }

    /**
     * Get the hundredth of seconds.
     * @return int
     */
    public function getHundredthOfSeconds(): int
    {
        return $this->getTotalHundredthOfSeconds() % 100;
    }

    /**
     * Get the total of tenth of seconds.
     * @return float
     */
    public function getTotalTenthOfSeconds(): float
    {
        return $this->getTotalMilliseconds() / 100;
    }

    /**
     * Get the tenth of seconds.
     * @return int
     */
    public function getTenthOfSeconds(): int
    {
        return $this->getTotalTenthOfSeconds() % 10;
    }

    /**
     * Get the total of seconds.
     * @return float
     */
    public function getTotalSeconds(): float
    {
        return $this->getTotalMilliseconds() / 1000;
    }

    /**
     * Get the seconds.
     * @return int
     */
    public function getSeconds(): int
    {
        return $this->getTotalSeconds() % 60;
    }

    /**
     * Get the total of minutes.
     * @return float
     */
    public function getTotalMinutes(): float
    {
        return $this->getTotalSeconds() / 60;
    }

    /**
     * Get the minutes.
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->getTotalMinutes() % 60;
    }

    /**
     * Get the total hours.
     * @return float
     */
    public function getTotalHours(): float
    {
        return $this->getTotalMinutes() / 60;
    }

    /**
     * Get the hours.
     * @return int
     */
    public function getHours(): int
    {
        return (int)$this->getTotalHours();
    }

    /**
     * Get the default format.
     * @static
     * @return string
     */
    public static function getDefaultFormat(): string
    {
        return static::$default_format;
    }
}