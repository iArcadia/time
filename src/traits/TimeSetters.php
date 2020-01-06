<?php

namespace iarcadia\time\traits;

use iarcadia\time\Time;

/**
 * Trait TimeSetters
 * @package iarcadia\time\traits
 */
trait TimeSetters
{
    /**
     * Set total timestamp.
     * @param float $timestamp
     * @return $this
     */
    public function setTimestamp(float $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Set the total of milliseconds.
     * @param float $v
     * @return $this
     */
    public function setTotalMilliseconds(float $v): self
    {
        return $this->setTimestamp($v);
    }

    /**
     * Set the total of seconds.
     * @param float $s
     * @return $this
     */
    public function setTotalSeconds(float $s): self
    {
        return $this->setTotalMilliseconds($s * 1000);
    }

    /**
     * Set the total minutes.
     * @param float $i
     * @return $this
     */
    public function setTotalMinutes(float $i): self
    {
        return $this->setTotalSeconds($i * 60);
    }

    /**
     * Set the total hours.
     * @param float $h
     * @return $this
     */
    public function setTotalHours(float $h): self
    {
        return $this->setTotalMinutes($h * 60);
    }
}