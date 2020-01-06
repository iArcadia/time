# Time

## Introduction

**_Time_** is A **PHP** time/duration library... again.

Currently, the library supports:

- Hours
- Minutes
- Seconds
- Milliseconds (+ Hundredth/Tenth of second)

The objective of this library is first to have something not related to dates at all, then to be light and simple.

## Usage

### Instantiation

With the `new` keyword:

```php
$time = new Time;
```

With the static method `create`:

```php
$time = Time::create();
```

The given arguments are the same for both methods:
```php
// true
new Time(56400) === Time::create(56400)

// true
new Time(0, 0, 56, 400) === Time::create(0, 0, 56, 400)

// true
new Time(56400) === Time::create(0, 0, 56, 400)
```

The static method will be used for the rest of the readme.

#### Time::create($h, $i, $s, $v)

```php
/**
* @param int|float $h - Hours
* @param int|float $i - Minutes
* @param int|float $s - Seconds
* @param int|float $v - Milliseconds
*
* @return iarcadia\time\Time
*/
```

##### Examples

Creating a Time of 17 hours and 19 minutes:

```php
$time = Time::create(17, 19, 0, 0);
```

Creating a Time of 45 minutes, 12 seconds and 476 ms:

```php
$time = Time::create(0, 45, 12, 476);
```

#### Time::create($int_or_float)

```php
/**
* @param int|float $int_or_float = 0 - Starting timestamp
*
* @return iarcadia\time\Time
*/
```

##### Examples

Creating a Time of 45 minutes, 12 seconds and 476 ms:

```php
$time = Time::create(2712476)
```

### Formating

The `format()` method is available to format and write your Time instance:

```php
/**
* @param string $format = '-h\h iim ss\s vvv'
*
* @return string
*/
```

Also, here's the characters or groups of characters which are going to be formated:

- `-` will appear if the time is negative
- `h` into hours
- `ii` into minutes with leading zero
- `i` into minutes
- `ss` into seconds with leading zero
- `s` into seconds
- `d` into tenth of seconds
- `cc` into hundredth of seconds with leading zero
- `c` into hundredth of seconds
- `vvv` into milliseconds with leading zero(s)
- `v` into milliseconds

Avoid a character to be translated by making it preceded by an antislash.

#### Examples

```php
$time = Time::create(1, 56, 4, 235);

// Write 1h 56m 04s 235
echo $time->format();
echo $time;

// Writes 1:56:04.235
echo $time->format('h:ii:ss.vvv');

// Writes 4 seconds and 235 ms
echo $time->format('s \se\con\d\s an\d vvv m\s');

// Write 04.2
echo $time->format('ss.d');
```

### Getters & Setters

The library proposes to you two different kinds of getters,
the classic ones and the total.

The classics will give you the capped int values, but the hours.
Minutes won't be over 59 and milliseconds over 999.

The total getters will give you a float value.

The getters also can all be used with magic attributes.

```php
$time = Time::create(2, 12, 32, 489);

// Write 2
echo $time->getHours();
echo $time->hours;

// Write 2.20
echo $time->getTotalHours();
echo $time->total_hours;

// Write 12
echo $time->getMinutes();
echo $time->minutes;

// Write 132.54
echo $time->getTotalMinutes();
echo $time->total_minutes;

// Write 32
echo $time->getSeconds();
echo $time->seconds;

// Write 7952.48
echo $time->getTotalSeconds();
echo $time->total_seconds;

// Write 4
echo $time->getTenthOfSeconds();
echo $time->tenth_of_seconds;

// Write 79524.89
echo $time->getTotalTenthOfSeconds();
echo $time->total_tenth_of_seconds;

// Write 48
echo $time->getHundredthOfSeconds();
echo $time->hundredth_of_seconds;

// Write 795248.9
echo $time->getTotalHundredthOfSeconds();
echo $time->total_hundredth_of_seconds;

// Write 489
echo $time->getMilliseconds();
echo $time->milliseconds;

// Write 7952489
echo $time->getTotalMilliseconds();
echo $time->total_milliseconds;
```

The setters will override the current timestamp of the Time instance.

They are also available as magic attributes.

```php
$time = Time::create(2, 12, 32, 489);

// Write 1h 30m 00s 000
$time->setTotalHours(1.5);
$time->total_hours = 1.5;
echo $time;

// Write 0h 30m 15s 000
$time->setTotalMinutes(30.25);
$time->total_minutes = 30.25;
echo $time;

// Write 0h 01m 15s 000
$time->setTotalSeconds(75);
$time->total_seconds = 75;
echo $time;

// Write 0h 00m 48s 600
$time->setTotalTenthOfSeconds(486);
$time->total_tenth_of_seconds = 486;
echo $time;

// Write 0h 01m 29s 610
$time->setTotalHundredthOfSeconds(8961);
$time->total_hundredth_of_seconds = 8961;
echo $time;


// Write 0h 02m 05s 658
$time->setTotalMilliseconds(125658);
$time->total_milliseconds = 125658;
echo $time;
```

### Negative times

Time instances can be negative at creation, just instantiate it with a negative timestamp.

```php
// Write -1h 35m 30s 210
$time = Time::create(-5703210);
echo $time;
```

Be aware that using `Time::create()` with 4 arguments will not work as intented for a negative time.

### Operations

Additions and substractions are possible with this library by using `Time#addX()` and `Time#subX()` methods.

```php
// Write 2h 49m 23s 486
$time = Time::create(60000);
$time
    ->addHours(2)
    ->addMinutes(48)
    ->addSeconds(23)
    ->addMilliseconds(486);
echo $time;
```

You can also do these operations with other Time instances thanks to `Time#addFromTime()` and `Time#subFromTime()`.

```php
// Write 0h 02m 15s 000
$time1 = Time::create(60000);
$time2 = Time::create(85000);
$time1->addFromTime($time2);
echo $time;

// Write 0h 01m 00s 000
$time1->subFromTime($time2);
echo $time;
```

Finally, shortcut methods exist : `Time#add()` and `Time#sub()`. These two methods accept many arguments at once, and accept integer/float values and Time object.

If 4 arguments are given, it will add/substract the same way as the instantiation with 4 arguments.

```php
// Write 0h 02m 15s 154
$time1 = Time::create(60000);
$time2 = Time::create(85000);
$time1->add($time2, 154);
echo $time;

// Write 0h 00m 00s 000
$time1->sub(0, 2, 15, 154);
echo $time;
```

The library proposes the `Time#diff()` and `Time::diffBetween()` methods to calculate difference between to times.

This feature is quite the same as `Time#sub()`, the only difference is that they return a new Time instance.

### Comparisons

You can compare two times by using comparison methods.

```php
$time1 = Time::create(1, 50, 0, 0);
$time2 = Time::create(3, 0, 24, 0);

// false
$time1->isEqualTo($time2);
$time1->eq($time2);

// true
$time1->isNotEqualTo($time2);
$time1->neq($time2);

// false
$time1->isGreaterThan($time2);
$time1->gt($time2);
$time1->isGreaterThanOrEqualTo($time2);
$time->gteq($time2);

// true
$time1->isLessThan($time2);
$time1->lt($time2);
$time1->isLessThanOrEqualTo($time2);
$time->lteq($time2);
```