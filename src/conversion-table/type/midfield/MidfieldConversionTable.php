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
        protected $_map = [
            [8, 4],
            [7, 3.5],
            [6, 3],
            [5, 2.5],
            [4, 2],
            [3, 1.5],
            [2, 1],
            [1, 0.5],
            [0, 0],
        ];
    }
}
