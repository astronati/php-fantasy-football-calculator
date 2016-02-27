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
class QuotationFactory implements QuotationFactoryInterface {

  /**
   * @inherit
   */
  public function create(array $config) {
    return new Quotation($config);
  }
}
