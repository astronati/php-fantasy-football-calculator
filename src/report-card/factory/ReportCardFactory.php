<?php

/**
 * A Report Card Factory allows to return a Report Card instance.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ReportCardFactoryInterface as ReportCardFactoryInterface;
    use \FFC\ReportCard as ReportCard;
    use \FFC\QuotationFactory as QuotationFactory;

    /**
     * Defines a ReportCardFactory
     * @codeCoverageIgnore
     */
    class ReportCardFactory implements ReportCardFactoryInterface {

        /**
         * Returns a new instance of the ReportCard class
         * @inheritDoc
         * @param array $config An array of quotations config needed to instantiate Quotation instances and then a
         * ReportCard one.
         * @return ReportCard
         */
        public function create(array $config) {
            return new ReportCard($config, new QuotationFactory());
        }
    }
}
