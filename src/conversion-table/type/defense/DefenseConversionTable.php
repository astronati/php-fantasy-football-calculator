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
     * Allows to map the defenders average with a bonus.
     */
    class DefenseConversionTable extends ConversionTableAbstract
    {
        /**
         * The map between the defense average and bonus/malus.
         * @type array
         */
        protected $_map = array(
            array(7, -5),
            array(6.75, -4),
            array(6.5, -3),
            array(6.25, -2),
            array(6, -1),
            array(5.75, 0),
            array(5.5, 1),
            array(5.25, 2),
            array(5, 3),
            array(0, 4)
        );
    }
}
