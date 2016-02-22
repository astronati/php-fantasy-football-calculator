<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.0.0
 */

/**
 * Defines a QuotationFactory
 */
class CalculatorFactory implements CalculatorFactoryInterface {

  /**
   * @inherit
   */
  public function create(array $quotations, $options = array()) {
    return new Calculator(
      $quotations,
      $options,
      new FormationFactory(),
      new QuotationFactory()
    );
  }
}
