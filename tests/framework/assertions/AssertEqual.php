<?php
namespace lindal1\tripsorter\tests\framework\assertions;

use lindal1\tripsorter\tests\framework\interfaces\IAssertion;
use lindal1\tripsorter\tests\framework\TestCase;

class AssertEqual implements IAssertion
{

    public static function run($data, TestCase $testCase)
    {
        if ($data[0] === $data[1]) {
            $testCase->success();
        } else {
            $testCase->fail();
        }
    }
}