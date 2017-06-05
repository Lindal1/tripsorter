<?php

namespace lindal1\tripsorter\tests\framework;

use lindal1\tripsorter\tests\framework\interfaces\IAssertion;

class TestCase
{

    protected $logger;
    protected $allowedAsserts = [];
    const ASSERTIONS_DIR = 'assertions/';

    public function __construct()
    {
        $this->logger = Logger::getInstance();
    }

    /**
     * @return void
     */
    public function success()
    {
        $data = $this->getTestCaseData();
        $this->logger->success($data['class'], $data['test']);
    }

    /**
     * @return void
     */
    public function fail()
    {
        $data = $this->getTestCaseData();
        $this->logger->fail($data['class'], $data['test']);
    }

    /**
     * @return array
     */
    private function getTestCaseData(): array
    {
        $trace = end(debug_backtrace());
        return [
            'class' => $trace['class'],
            'test' => $trace['function']
        ];
    }

    /**
     * @inheritdoc
     */
    public function __call($name, $arguments)
    {
        if (stripos($name, 'assert') !== false && $assert = $this->getAssert($name)) {
            $assert::run($arguments[0], $this);
        }
    }

    /**
     * @param $assertName
     * @return IAssertion|null
     */
    private function getAssert($assertName)
    {
        $allowed = $this->getAllowedAsserts();
        if (isset($allowed[strtolower($assertName)])) {
            return $allowed[strtolower($assertName)];
        }
        return null;
    }

    /**
     * @return array
     */
    private function getAllowedAsserts(): array
    {
        if (!$this->allowedAsserts) {
            $this->allowedAsserts = $this->getAssertsFromDirectory();
        }
        return $this->allowedAsserts;
    }

    /**
     * @return array
     */
    private function getAssertsFromDirectory(): array
    {
        $dir = __DIR__ . '/' . self::ASSERTIONS_DIR;
        $files = glob($dir . '*.php');
        $result = [];
        foreach ($files as $file) {
            $className = substr(basename($file), 0, strripos(basename($file), '.php'));
            $result[strtolower($className)] = 'lindal1\tripsorter\tests\framework\assertions\\' . $className;
        }
        return $result;
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

}