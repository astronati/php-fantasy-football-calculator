<?php

/**
 * Used to determine which footballers are reserves or not.
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    /**
     * Defines the interface of a Formation
     */
    interface FormationInterface {

        /**
         * Returns footballers of the formation. They can be filtered in order to obtain a specif subset like:
         *
         * - all defenders as first strings
         * - all forwards as reserves
         * - ...
         *
         * @return array
         */
        public function getFootballers();

        /**
         * Filters formation by goalkeepers.
         */
        public function filterGoalkeepers();

        /**
         * Filters formation by defenders.
         */
        public function filterDefenders();

        /**
         * Filters formation by midfielders.
         */
        public function filterMidfielders();

        /**
         * Filters formation by forwards.
         */
        public function filterForwards();

        /**
         * Filters formation by first strings.
         */
        public function filterFirstStrings();

        /**
         * Filters formation by reserves.
         */
        public function filterReserves();
    }
}
