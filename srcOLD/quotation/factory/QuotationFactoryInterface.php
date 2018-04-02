<?php

/**
 * Implements the Factory pattern to return an instance of Quotation
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    /**
     * Defines the interface of the Quotation Factory
     * @codeCoverageIgnore
     */
    interface QuotationFactoryInterface {

        /**
         * Implements the Factory Pattern.
         *
         * @param array $config
         * @return Quotation
         */
        public function create(array $config);
    }
}
