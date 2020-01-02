<?php

namespace iArcadia\Time\Traits;

use iArcadia\Time\Time;

/**
 * Trait TimeOperation
 * @package iArcadia\Time\Traits
 */
trait TimeOperation
{
    /**
     * Add time to the instance.
     * @param Time|int|float ...$args
     * @return $this
     */
    public function add(...$args): self
    {
        // If 4 arguments, then there are: h, i, s and v.
        if (sizeof($args) === 4) {
            $onlyNumbers = true;

            foreach ($args as $arg) {
                if (!is_numeric($arg)) {
                    $onlyNumbers = false;
                    break;
                }
            }

            if ($onlyNumbers) {
                return $this->addAllUnits(...$args);
            }
        }

        // Else, arguments are Time instance or int/float timestamps.
        foreach ($args as $arg) {
            if (is_a($arg, Time::class)) {
                $this->addFromTime($arg);
            }

            if (is_numeric($arg)) {
                $this->addMilliseconds($arg);
            }
        }

        return $this;
    }

    /**
     * Substract time to the instance.
     * @param Time|int|float ...$args
     * @return $this
     */
    public function sub(...$args): self
    {
        // If 4 arguments, and they are all int/float numbers, then they are: h, i, s and v.
        if (sizeof($args) === 4) {
            $onlyNumbers = true;

            foreach ($args as $arg) {
                if (!is_numeric($arg)) {
                    $onlyNumbers = false;
                    break;
                }
            }

            if ($onlyNumbers) {
                return $this->subAllUnits(...$args);
            }
        }

        // Else, arguments are Time instance or int/float timestamps.
        foreach ($args as $arg) {
            if (is_a($arg, Time::class)) {
                $this->subFromTime($arg);
            }

            if (is_numeric($arg)) {
                $this->subMilliseconds($arg);
            }
        }

        return $this;
    }

    /**
     * Add $time timestamp to this instance.
     * @param Time $time
     * @return $this
     */
    public function addFromTime(Time $time): self
    {
        return $this->setTimestamp($this->getTimestamp() + $time->getTimestamp());
    }

    /**
     * Substract $time timestamp to this instance.
     * @param Time $time
     * @return $this
     */
    public function subFromTime(Time $time): self
    {
        return $this->setTimestamp($this->getTimestamp() - $time->getTimestamp());
    }

    /**
     * Add all time units.
     * @protected
     * @param float $h
     * @param float $i
     * @param float $s
     * @param float $v
     * @return $this
     */
    protected function addAllUnits(float $h = 0.0, float $i = 0.0, float $s = 0.0, float $v = 0.0): self
    {
        return
            $this
                ->addHours($h)
                ->addMinutes($i)
                ->addSeconds($s)
                ->addMilliseconds($v);
    }

    /**
     * Substract all time units.
     * @protected
     * @param float $h
     * @param float $i
     * @param float $s
     * @param float $v
     * @return $this
     */
    protected function subAllUnits(float $h = 0.0, float $i = 0.0, float $s = 0.0, float $v = 0.0): self
    {
        return
            $this
                ->subHours($h)
                ->subMinutes($i)
                ->subSeconds($s)
                ->subMilliseconds($v);
    }

    /**
     * Add milliseconds.
     * @param float $v
     * @return $this
     */
    public function addMilliseconds(float $v): self
    {
        return $this->setTimestamp($this->getTimestamp() + $v);
    }

    /**
     * Substract milliseconds.
     * @param float $v
     * @return $this
     */
    public function subMilliseconds(float $v): self
    {
        return $this->setTimestamp($this->getTimestamp() - $v);
    }

    /**
     * Add seconds.
     * @param float $s
     * @return $this
     */
    public function addSeconds(float $s): self
    {
        return $this->addMilliseconds($s * 1000);
    }

    /**
     * Substract seconds.
     * @param float $s
     * @return $this
     */
    public function subSeconds(float $s): self
    {
        return $this->subMilliseconds($s * 1000);
    }

    /**
     * Add minutes.
     * @param float $i
     * @return $this
     */
    public function addMinutes(float $i): self
    {
        return $this->addSeconds($i * 60);
    }

    /**
     * Substract minutes.
     * @param float $i
     * @return $this
     */
    public function subMinutes(float $i): self
    {
        return $this->subSeconds($i * 60);
    }

    /**
     * Add hours.
     * @param float $h
     * @return $this
     */
    public function addHours(float $h): self
    {
        return $this->addMinutes($h * 60);
    }

    /**
     * Subtract hours.
     * @param float $h
     * @return $this
     */
    public function subHours(float $h): self
    {
        return $this->subMinutes($h * 60);
    }

    /**
     * Build a Time instance which represents the difference between this one and the $time one.
     * @param Time $time
     * @return Time
     */
    public function diff(Time $time): Time
    {
        $diff = clone $this;

        return $diff->sub($time);
    }

    /**
     * Build a Time instance which represents the difference between $a and $b.
     * @static
     * @param Time $a
     * @param Time $b
     * @return Time
     */
    public static function diffBetween(Time $a, Time $b): Time
    {
        return $a->diff($b);
    }
}