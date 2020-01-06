<?php

require_once('../vendor/autoload.php');

use iarcadia\time\Time;

$method = $_GET['operation'] ?? 'add';
$time = Time::create($_GET['time'] ?? 0)
    ->$method($_GET['hours'] ?? 0, $_GET['minutes'] ?? 0, $_GET['seconds'] ?? 0, $_GET['milliseconds'] ?? 0);

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">

    <title>iarcadia/time - Time Calculator</title>
</head>

<body>
<h1>Time Calculator</h1>
<h2>iarcadia/time</h2>

<form action="#" method="GET">
    <input type="hidden" name="time" value="<?= $time->getTimestamp() ?>">

    <select name="format">
        <option value="">0h 00m 00s 000</option>
        <option value="h:ii:ss.vvv" <?= ($_GET['format'] === 'h:ii:ss.vvv') ? 'selected' : '' ?>>0:00:00.000</option>
    </select>

    <br>

    <select name="operation">
        <option value="add">Add</option>
        <option value="sub">Subtract</option>
    </select>

    <input type="number" min="0" name="hours" placeholder="h" value="0">h
    <input type="number" min="0" max="59" name="minutes" placeholder="m" value="0">m
    <input type="number" min="0" max="59" name="seconds" placeholder="s" value="0">s
    <input type="number" min="0" max="999" name="milliseconds" placeholder="ms" value="0">

    <button type="submit">Do</button>
</form>

<p><?= $time->format($_GET['format'] ?? '') ?></p>
</body>
</html>