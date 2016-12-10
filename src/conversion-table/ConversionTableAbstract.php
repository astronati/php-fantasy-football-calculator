<?php

/**
 * Used to map a range of values with a well defined bonus/malus.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ConversionTableInterface as ConversionTableInterface;

    /**
     * Defines the abstract of a Conversion Table.
     */
    abstract class ConversionTableAbstract implements ConversionTableInterface {

        /**
         * A map between range and values.
         * The first value is the minimum value in order to have the second one as result.
         * Ranges are ordered by descendant value.
         * @type array
         */
        protected $_map = array();

        /**
         * Returns the converted value, given a value in a range.
         *
         * @param float $value
         * @return float
         */
        public function getConvertedValue($value) {
            foreach ($this->_map as $limit) {
                if ($value >= $limit[0]) {
                    return $limit[1];
                }
            }
            return 0;
        }
    }
}
