<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Runs tests suite of the project
     */
    public function test()
    {
        $cmd = [];
        array_push($cmd, './vendor/phpunit/phpunit/phpunit ./src');
        array_push($cmd, '--coverage-html test/report/html');
        array_push($cmd, '--coverage-xml test/report/xml');
        array_push($cmd, '--whitelist ./src');
        $this->_exec(implode(' ', $cmd));
    }

    /**
     * Generates documentation of the project
     */
    public function docs()
    {
        $cmd = array();
        array_push($cmd, './vendor/phpdocumentor/phpdocumentor/bin/phpdoc');
        array_push($cmd, '-d ./src');
        array_push($cmd, '-t ./docs/api');
        array_push($cmd, '--ignore="**/*Test.php"');
        $this->_exec(implode(' ', $cmd));
    }
}