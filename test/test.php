<?php

require __DIR__ . "/../vendor/autoload.php";

$formatter = new \ChangeLog\Formatter(__DIR__ . '/../CHANGELOG.md');

var_dump($formatter->getLastVersion());
echo PHP_EOL;
