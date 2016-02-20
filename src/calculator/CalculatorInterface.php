<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines the interface of a Calculator
 */
interface CalculatorInterface {

  /**
   * Returns votes of each footballer and the totals of the formation.
   *
   * @param Array $footballers
   * @returns Array
   */
  public function calc(array $footballers);
}
