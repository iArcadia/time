<?php

namespace iarcadia\time\traits;

/**
 * Trait TimeFormatter
 * @package iarcadia\time\traits
 */
trait TimeFormatter
{
    /**
     * Get the time into the given format.
     * @param string|null $format
     * @return string
     */
    public function format(?string $format = null): string
    {
        if (!$format) {
            return $this->formatDefault();
        }

        $str = $format;

        $symbol = ($this->isNegative()) ? '-' : '';
        $h = abs($this->getHours());
        $i = abs($this->getMinutes());
        $s = abs($this->getSeconds());
        $ds = abs($this->getTenthOfSeconds());
        $cs = abs($this->getHundredthOfSeconds());
        $v = abs($this->getMilliseconds());

        $str = preg_replace('/(?<!\\\)-/', $symbol, $str);

        $str = preg_replace('/(?<!\\\)h/', $h, $str);

        $str = preg_replace('/(?<!\\\)ii/', str_pad($i, 2, '0', STR_PAD_LEFT), $str);
        $str = preg_replace('/(?<!\\\)ss/', str_pad($s, 2, '0', STR_PAD_LEFT), $str);
        $str = preg_replace('/(?<!\\\)cc/', str_pad($cs, 2, '0', STR_PAD_LEFT), $str);
        $str = preg_replace('/(?<!\\\)vvv/', str_pad($v, 3, '0', STR_PAD_LEFT), $str);

        $str = preg_replace('/(?<!\\\)i/', $i, $str);
        $str = preg_replace('/(?<!\\\)s/', $s, $str);
        $str = preg_replace('/(?<!\\\)d/', $ds, $str);
        $str = preg_replace('/(?<!\\\)c/', $cs, $str);
        $str = preg_replace('/(?<!\\\)v/', $v, $str);

        $str = preg_replace('/\\\([hisvdc])/', '$1', $str);

        return $str;
    }

    /**
     * Get the time into the default format.
     * @protected
     * @return string
     */
    protected function formatDefault(): string
    {
        return $this->format(static::getDefaultFormat());
    }

    /**
     * Set the default format.
     * @static
     * @param string $format
     * @return void
     */
    public static function setDefaultFormat(string $format): void
    {
        static::$default_format = $format;
    }
}