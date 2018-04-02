<?php

/**
 * A Quotation Factory allows to return a Quotation instance.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    use \FFC\QuotationFactoryInterface as QuotationFactoryInterface;
    use \FFC\Quotation as Quotation;

    /**
     * Defines a QuotationFactory
     * @codeCoverageIgnore
     */
    class QuotationFactory implements QuotationFactoryInterface {

        /**
         * Returns a new instance of the Quotation class
         * @inheritDoc
         * @param array $config An array containing all those data needed to instantiate a Quotation
         * @return Quotation
         */
        public function create(array $config) {
            return new Quotation($config);
        }
    }
}
