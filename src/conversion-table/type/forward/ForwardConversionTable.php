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
     * Allows to map the forwards average with a bonus.
     */
    class ForwardConversionTable extends ConversionTableAbstract
    {
        /**
         * The map between the forward average and bonus/malus.
         * @type array
         */
        protected $_map = [
            [8, 2],
            [7.5, 1.5],
            [7, 1],
            [6.5, 0.5],
        ];
    }
}
