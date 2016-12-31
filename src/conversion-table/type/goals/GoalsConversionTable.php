<?php

/**
 * Used to map a range of magic points with related goals.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC
{
    use \FFC\ConversionTableAbstract as ConversionTableAbstract;

    /**
     * Allows to map the sum of points of a formation with the number of goals.
     */
    class GoalsConversionTable extends ConversionTableAbstract
    {
        /**
         * The map between the sum of magic points of a formation and related goals.
         * @type array
         */
        protected $_map = [
            [120, 10],
            [114, 9],
            [108, 8],
            [102, 7],
            [96, 6],
            [90, 5],
            [84, 4],
            [78, 3],
            [72, 2],
            [66, 1],
        ];
    }
}
