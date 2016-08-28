<?php

use \FFC\QuotationFactoryInterface as QuotationFactoryInterface;
use \FFC\Quotation as Quotation;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

namespace FFC {

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
  
}
