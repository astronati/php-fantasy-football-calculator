<?php

/**
 * A ConversionTableFactory allows to return a ConversionTable instance.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC
{
    use \FFC\ConversionTableFactoryInterface as ConversionTableFactoryInterface;
    use \FFC\BestDefendersConversionTable as BestDefendersConversionTable;
    use \FFC\DefenseConversionTable as DefenseConversionTable;
    use \FFC\MidfieldConversionTable as MidfieldConversionTable;
    use \FFC\ForwardConversionTable as ForwardConversionTable;
    use \FFC\GoalsConversionTable as GoalsConversionTable;

    /**
     * Defines a ConversionTableFactory
     * @codeCoverageIgnore
     */
    class ConversionTableFactory implements ConversionTableFactoryInterface
    {
        /**
         * Returns a new instance of the BestDefendersConversionTable
         * @inheritDoc
         * @param number $type
         * @return BestDefendersConversionTable
         */
        public function createBestDefendersConversionTable()
        {
            return new BestDefendersConversionTable();
        }

        /**
         * Returns a new instance of the DefenseConversionTable
         * @inheritDoc
         * @return DefenseConversionTable
         */
        public function createDefenseConversionTable()
        {
            return new DefenseConversionTable();
        }

        /**
         * Returns a new instance of the MidfieldConversionTable
         * @inheritDoc
         * @return MidfieldConversionTable
         */
        public function createMidfieldConversionTable()
        {
            return new MidfieldConversionTable();
        }

        /**
         * Returns a new instance of the ForwardConversionTable
         * @inheritDoc
         * @return ForwardConversionTable
         */
        public function createForwardConversionTable()
        {
            return new ForwardConversionTable();
        }

        /**
         * Returns a new instance of the GoalsConversionTable
         * @inheritDoc
         * @return GoalsConversionTable
         */
        public function createGoalsConversionTable()
        {
            return new GoalsConversionTable();
        }
    }
}
