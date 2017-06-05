<?php

namespace lindal1\tripsorter\tests\framework;

class Logger
{

    private static $instance;

    private $log = [
        'success' => [],
        'fail' => []
    ];

    private function __construct()
    {
    }

    /**
     * Return logger singleton
     * @return Logger
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Write success message
     * @param $class
     * @param $test
     */
    public function success($class, $test)
    {
        $this->log['success'][] = [
            'class' => $class,
            'test' => $test
        ];
    }

    /**
     * Write fail message
     * @param $class
     * @param $test
     */
    public function fail($class, $test)
    {
        $this->log['fail'][] = [
            'class' => $class,
            'test' => $test
        ];
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }

    public function clearLog()
    {
        $this->log = [
            'success' => [],
            'fail' => []
        ];
    }

    /**
     * @return array
     */
    public function getSuccessLog(): array
    {
        return $this->log['success'];
    }

    /**
     * @return array
     */
    public function getFailLog(): array
    {
        return $this->log['fail'];
    }

}