<?php

/**
 * Used to map a range of average of defenders values with a well defined bonus.
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
     * Allows to map the defenders average with a bonus.
     */
    class DefenseConversionTable extends ConversionTableAbstract
    {
        /**
         * The map between the defense average and bonus/malus.
         * @type array
         */
        protected $_map = [
            [7, -5],
            [6.75, -4],
            [6.5, -3],
            [6.25, -2],
            [6, -1],
            [5.75, 0],
            [5.5, 1],
            [5.25, 2],
            [5, 3],
            [0, 4],
        ];
    }
}
