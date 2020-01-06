<?php

namespace iarcadia\time\traits;

use iarcadia\time\Time;

/**
 * Trait TimeComparison
 * @package iarcadia\time\traits
 */
trait TimeComparison
{
    /**
     * Check if this instance is exactly equal to the $time one.
     * @param Time $time
     * @return bool
     */
    public function isEqualTo(Time $time): bool
    {
        return $this->getTimestamp() === $time->getTimestamp();
    }

    /**
     * Alias for Time#isEqualTo().
     * @param mixed ...$args
     * @return bool
     */
    public function eq(...$args): bool
    {
        return $this->isEqualTo(...$args);
    }

    /**
     * Check if this instance is not equal to the $time one.
     * @param Time $time
     * @return bool
     */
    public function isNotEqualTo(Time $time): bool
    {
        return !$this->isEqualTo($time);
    }

    /**
     * Alias for Time#isNotEqualTo().
     * @param mixed ...$args
     * @return bool
     */
    public function neq(...$args): bool
    {
        return $this->isNotEqualTo(...$args);
    }

    /**
     * Check if the instance is greater than the $time one.
     * @param Time $time
     * @return bool
     */
    public function isGreaterThan(Time $time): bool
    {
        return $this->getTimestamp() > $time->getTimestamp();
    }

    /**
     * Alias for Time#isGreaterThan().
     * @param mixed ...$args
     * @return bool
     */
    public function gt(...$args): bool
    {
        return $this->isGreaterThan(...$args);
    }

    /**
     * Check if the instance is greater than or equal to the $time one.
     * @param Time $time
     * @return bool
     */
    public function isGreaterThanOrEqualTo(Time $time): bool
    {
        return $this->getTimestamp() >= $time->getTimestamp();
    }

    /**
     * Alias for Time#isGreaterThanOrEqualTo().
     * @param mixed ...$args
     * @return bool
     */
    public function gteq(...$args): bool
    {
        return $this->isGreaterThanOrEqualTo(...$args);
    }

    /**
     * Check if the instance is lesser than the $time one.
     * @param Time $time
     * @return bool
     */
    public function isLesserThan(Time $time): bool
    {
        return $this->getTimestamp() < $time->getTimestamp();
    }

    /**
     * Alias for Time#isLesserThan().
     * @param mixed ...$args
     * @return bool
     */
    public function lt(...$args): bool
    {
        return $this->isLesserThan(...$args);
    }

    /**
     * Check if the instance is lesser than or equal to the $time one.
     * @param Time $time
     * @return bool
     */
    public function isLesserThanOrEqualTo(Time $time): bool
    {
        return $this->getTimestamp() <= $time->getTimestamp();
    }

    /**
     * Alias for Time#isLesserThanOrEqualTo().
     * @param mixed ...$args
     * @return bool
     */
    public function lteq(...$args): bool
    {
        return $this->isLesserThanOrEqualTo(...$args);
    }
}