<?php

/**
 * Used to define a footballer instance with properties like:
 *
 * - id
 * - role
 * - type
 * - ...
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    /**
     * Defines the interface of a footballer.
     */
    interface FootballerInterface {

        /**
         * Returns the ID of the footballer.
         *
         * @return integer
         */
        public function getId();

        /**
         * Determines if the footballer is one of the first strings in the current formation.
         *
         * @returns boolean
         */
        public function isFirstString();

        /**
         * Determines if the footballer is one of the reserves in the current formation.
         *
         * @returns boolean
         */
        public function isReserve();

        /**
         * Determines if the role of the footballer is the goalkeeper.
         *
         * @returns boolean
         */
        public function isGoalkeeper();

        /**
         * Determines if the role of the footballer is the defender.
         *
         * @returns boolean
         */
        public function isDefender();

        /**
         * Determines if the role of the footballer is the midfielder.
         *
         * @returns boolean
         */
        public function isMidfielder();

        /**
         * Determines if the role of the footballer is the forward.
         *
         * @returns boolean
         */
        public function isForward();
    }
}
