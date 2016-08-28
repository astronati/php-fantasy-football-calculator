<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

namespace FFC {

  /**
   * Defines the interface of the Quotation Factory
   */
  interface QuotationFactoryInterface {
  
    /**
     * Returns a new instance of the Quotation class
     *
     * @param Array $config
     * @return Quotation
     */
    public function create(array $config);
}
  
}
