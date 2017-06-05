<?php

use lindal1\tripsorter\tests\framework\Logger;

require_once 'vendor/autoload.php';
require_once 'tests/cases/BoardingCardTest.php';
require_once 'tests/cases/FormatterTest.php';
require_once 'tests/cases/SorterTest.php';
require_once 'tests/cases/BoardingCardFactoryTest.php';
require_once 'tests/cases/FormatterFactoryTest.php';

$tests = [
    new BoardingCardTest(),
    new FormatterTest(),
    new SorterTest(),
    new BoardingCardFactoryTest(),
    new FormatterFactoryTest()
];

foreach ($tests as $test) {
    foreach (get_class_methods($test) as $method) {
        if (stripos($method, 'test') !== false) {
            $test->$method();
        }
    }
}

echo "Success: " . count(Logger::getInstance()->getSuccessLog()) . "\n";
echo "Fail: " . count(Logger::getInstance()->getFailLog()) . "\n";