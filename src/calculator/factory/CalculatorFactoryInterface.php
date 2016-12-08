<?php

/**
 * It implements the Factory pattern to return a Calculator instance in order to allow dependency injection.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    /**
     * Defines the interface of the Calculator Factory.
     * It implements the Factory pattern.
     * @codeCoverageIgnore
     */
    interface CalculatorFactoryInterface {

        /**
         * Returns a new instance of the Calculator class.
         *
         * @param array $quotations
         * @param array $options
         * @return Calculator
         */
        public static function create(array $quotations, $options = array());
    }
}
