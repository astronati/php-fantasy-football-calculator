<?php

/**
 * A Modifier Factory allows to return a Modifier instance.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ModifierFactoryInterface as ModifierFactoryInterface;
    use \FFC\BestDefendersModifier as BestDefendersModifier;
    use \FFC\DefenseModifier as DefenseModifier;
    use \FFC\MidfieldModifier as MidfieldModifier;
    use \FFC\ForwardModifier as ForwardModifier;
    use \FFC\ConversionTableFactory as ConversionTableFactory;

    /**
     * Defines a QuotationFactory
     * @codeCoverageIgnore
     */
    class ModifierFactory implements ModifierFactoryInterface {

        /**
         * An instance of ConversionTableFactory
         */
        private $_conversionTableFactory;

        /**
         * Instantiates the ConversionTableFactory
         */
        public function __construct()
        {
            $this->_conversionTableFactory = new ConversionTableFactory();
        }

        /**
         * Returns a new instance of the BestDefendersModifier
         * @inheritDoc
         * @param number $type
         * @return BestDefendersModifier
         */
        public function createBestDefendersModifier()
        {
            return new BestDefendersModifier($this->_conversionTableFactory->createBestDefendersConversionTable());
        }

        /**
         * Returns a new instance of the DefenseModifier
         * @inheritDoc
         * @param number $type
         * @return DefenseModifier
         */
        public function createDefenseModifier()
        {
            return new DefenseModifier($this->_conversionTableFactory->createDefenseConversionTable());
        }

        /**
         * Returns a new instance of the MidfieldModifier
         * @inheritDoc
         * @param number $type
         * @return MidfieldModifier
         */
        public function createMidfieldModifier()
        {
            return new MidfieldModifier($this->_conversionTableFactory->createMidfieldConversionTable());
        }

        /**
         * Returns a new instance of the ForwardModifier
         * @inheritDoc
         * @param number $type
         * @return ForwardModifier
         */
        public function createForwardModifier()
        {
            return new ForwardModifier($this->_conversionTableFactory->createForwardConversionTable());
        }
    }
}
