<?php

/**
 * Used to map a range of average of defenders values with a well defined bonus.
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
     * Allows to map the midfields difference with a bonus/malus.
     */
    class MidfieldConversionTable extends ConversionTableAbstract
    {
        /**
         * The map between the difference between two midfields and bonus/malus.
         * @type array
         */
        protected $_map = array(
            array(8, 4),
            array(7, 3.5),
            array(6, 3),
            array(5, 2.5),
            array(4, 2),
            array(3, 1.5),
            array(2, 1),
            array(1, 0.5),
            array(0, 0),
        );
    }
}
