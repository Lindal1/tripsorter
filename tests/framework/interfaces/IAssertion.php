<?php
namespace lindal1\tripsorter\tests\framework\interfaces;

use lindal1\tripsorter\tests\framework\TestCase;

interface IAssertion
{
    /**
     * @param mixed $data
     * @param TestCase $testCase
     * @return void
     */
    public static function run($data, TestCase $testCase);
}