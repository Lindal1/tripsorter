<?php

namespace lindal1\tripsorter\tests\framework\assertions;

use lindal1\tripsorter\tests\framework\interfaces\IAssertion;
use lindal1\tripsorter\tests\framework\TestCase;

class AssertTrue implements IAssertion
{

    public static function run($data, TestCase $testCase)
    {
        if ($data == true) {
            $testCase->success();
        } else {
            $testCase->fail();
        }
    }
}