<?php

/**
 * Implements the Factory pattern to return an instance of Quoatation
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    /**
     * Defines the interface of the Quotation Factory
     */
    interface QuotationFactoryInterface {

        /**
         * Returns a new instance of the Quotation class
         *
         * @param array $config
         * @return Quotation
         */
        public function create(array $config);
    }
}
