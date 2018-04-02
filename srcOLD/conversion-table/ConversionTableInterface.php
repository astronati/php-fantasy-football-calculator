<?php

/**
 * Used to map a range of values with a well defined bonus/malus.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    /**
     * Defines the interface of a Conversion Table.
     */
    interface ConversionTableInterface {

        /**
         * Returns the converted value, given a value in a range.
         *
         * @param float $value
         * @return float
         */
        public function getConvertedValue($value);
    }
}
