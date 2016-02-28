<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines the interface of the Calculator Factory
 */
interface CalculatorFactoryInterface {

  /**
   * Returns a new instance of the Calculator class
   *
   * @param Array $quotations
   * @param Array $options
   * @return Calculator
   */
  public static function create(array $quotations, $options = array());
}
