<?php

/**
 * Used to map a range of magic points with related goals.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
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
        protected $_map = array(
            array(120, 10),
            array(114, 9),
            array(108, 8),
            array(102, 7),
            array(96, 6),
            array(90, 5),
            array(84, 4),
            array(78, 3),
            array(72, 2),
            array(66, 1),
        );
    }
}
