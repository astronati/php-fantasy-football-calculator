<?php

/**
 * A quotation contains following information for each footballer after a
 * match:
 *
 * - id (of the footballer)
 * - magic points (vote + modifiers)
 * - vote
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    /**
     * Defines the interface of a Quotation.
     */
    interface QuotationInterface {

        /**
         * Returns the id of the footballer associated to the quotation.
         *
         * @return integer
         */
        public function getFootballerId();

        /**
         * Returns the magic points of the footballer.
         *
         * @return float
         */
        public function getMagicPoints();

        /**
         * Returns the vote of the footballer.
         *
         * @return float
         */
        public function getVote();

        /**
         * Returns the goal bonus of the footballer.
         *
         * @return integer
         */
        public function getGoal();

        /**
         * Returns the caution malus of the footballer.
         *
         * @return float
         */
        public function getCaution();

        /**
         * Returns the expulsion malus of the footballer.
         *
         * @return integer
         */
        public function getExpulsion();

        /**
         * Returns the penalty bonus/malus of the footballer.
         *
         * @return integer
         */
        public function getPenalty();

        /**
         * Returns the auto goal malus of the footballer.
         *
         * @return integer
         */
        public function getAutoGoal();

        /**
         * Returns the assist bonus of the footballer.
         *
         * @return integer
         */
        public function getAssist();

        /**
         * Returns the quotation as an array:
         * [
         *  'key' => value,
         *  ...
         * ]
         *
         * @return array
         */
        public function toArray();
    }
}