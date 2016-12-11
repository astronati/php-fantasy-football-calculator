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
     * Allows to map the average between the goalkeeper and the best 3 defenders with a bonus.
     */
    class BestDefendersConversionTable extends ConversionTableAbstract
    {
        /**
         * The map between the defense average and bonus.
         * @type array
         */
        protected $_map = [
            [7, 6],
            [6.5, 3],
            [6, 1],
        ];
    }
}
