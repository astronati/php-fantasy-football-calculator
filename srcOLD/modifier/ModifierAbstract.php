<?php

/**
 * Implements the Abstract for a generic Modifier
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC
{
    use \FFC\ModifierInterface as ModifierInterface;
    use \FFC\ConversionTableAbstract as ConversionTableAbstract;

    /**
     * A Modifier requires a Conversion Table in order to applye the appropriate bonus/malus.
     * @codeCoverageIgnore
     */
    abstract class ModifierAbstract implements ModifierInterface
    {
        /**
         * An instance of a ConversionTableAbstract
         * @var ConversionTableAbstract
         */
        protected $_conversionTable;

        /**
         * Returns the average from a list of numbers
         * @private
         * @param float[] $array
         * @return float
         */
        protected function _getAverage(array $array)
        {
            return array_sum($array) / count($array);
        }

        /**
         * Returns the malus/bonus given from the modifier.
         * @inheritDoc
         * @param array $config
         */
        abstract public function getBonus(array $config);

        /**
         * A ModifierAbstract needs a ConversionTableAbstract in order to return the right bonus/malus.
         *
         * @param ConversionTableAbstract $conversionTable
         */
        public function __construct(ConversionTableAbstract $conversionTable)
        {
            $this->_conversionTable = $conversionTable;
        }
    }
}
