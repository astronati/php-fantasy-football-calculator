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
    $this->_exec('./vendor/phpunit/phpunit/phpunit ./src --coverage-html temp/report');
  }

  /**
   * Generates documentation of the project
   */
  public function docs()
  {
    $this->_exec('./vendor/phpdocumentor/phpdocumentor/bin/phpdoc -d ./src -t ./docs/api --ignore="**/*Test.php"');
  }
}