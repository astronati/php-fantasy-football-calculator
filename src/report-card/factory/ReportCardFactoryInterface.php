<?php

/**
 * Implements the Factory pattern to return an instance of ReportCard
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    /**
     * Defines the interface of the Report Card Factory
     * @codeCoverageIgnore
     */
    interface ReportCardFactoryInterface {

        /**
         * Implements the Factory Pattern.
         * Creates an instance of the ReportCardFactory
         *
         * @see ReportCard
         * @see Quotation::_fields to figure out the needed fields for a quotation instance.
         * @param array $config An array containing a list of configurations for Quotation instances. Quotations are
         * needed to create an instance of the ReportCard class
         * @return ReportCard An instance of the class
         */
        public function create(array $config);
    }
}
