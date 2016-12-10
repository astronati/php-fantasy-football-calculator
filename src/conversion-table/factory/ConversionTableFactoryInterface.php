<?php

/**
 * Implements the Factory pattern to return an instance of ConversionTableInterface
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC
{
    /**
     * Defines the interface of the ConversionTableFactory
     * @codeCoverageIgnore
     */
    interface ConversionTableFactoryInterface
    {
        /**
         * Implements the Factory Pattern.
         * Returns an instance of ConversionTableInterface.
         *
         * @return ConversionTableInterface
         */
        public function createBestDefendersConversionTable();

        /**
         * Implements the Factory Pattern.
         * Returns an instance of ConversionTableInterface.
         *
         * @return ConversionTableInterface
         */
        public function createDefenseConversionTable();

        /**
         * Implements the Factory Pattern.
         * Returns an instance of ConversionTableInterface.
         *
         * @return ConversionTableInterface
         */
        public function createMidfieldConversionTable();

        /**
         * Implements the Factory Pattern.
         * Returns an instance of ConversionTableInterface.
         *
         * @return ConversionTableInterface
         */
        public function createForwardConversionTable();

        /**
         * Implements the Factory Pattern.
         * Returns an instance of ConversionTableInterface.
         *
         * @return ConversionTableInterface
         */
        public function createGoalsConversionTable();
    }
}
