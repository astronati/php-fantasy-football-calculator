<?php

/**
 * Implements the Factory pattern to return an instance of Modifier
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    /**
     * Defines the interface of the Modifier Factory
     * @codeCoverageIgnore
     */
    interface ModifierFactoryInterface {

        /**
         * Implements the Factory Pattern.
         * Returns an Instance of ModifierInterface.
         *
         * @return ModifierInterface
         */
        public function createBestDefendersModifier();

        /**
         * Implements the Factory Pattern.
         * Returns an Instance of ModifierInterface.
         *
         * @return ModifierInterface
         */
        public function createDefenseModifier();

        /**
         * Implements the Factory Pattern.
         * Returns an Instance of ModifierInterface.
         *
         * @return ModifierInterface
         */
        public function createMidfieldModifier();

        /**
         * Implements the Factory Pattern.
         * Returns an Instance of ModifierInterface.
         *
         * @return ModifierInterface
         */
        public function createForwardModifier();
    }
}
