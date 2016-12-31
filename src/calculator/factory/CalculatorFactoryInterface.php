<?php

/**
 * It implements the Factory pattern to return a Calculator instance in order to allow dependency injection.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {
    /**
     * Defines the interface of the Calculator Factory.
     * @codeCoverageIgnore
     */
    interface CalculatorFactoryInterface
    {
        /**
         * Implements the Factory pattern.
         *
         * @param array $quotations
         * @return Calculator
         */
        public function create(array $quotations);
    }
}
