<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
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
         * Returns the role of the footballer.
         *
         * @return string
         */
        public function getRole();

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
    }
}
