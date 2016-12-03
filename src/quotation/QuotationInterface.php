<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    /**
     * Defines the interface of a Quotation. A quotation contains following information for each footballer after a match:
     * - id (of the footballer)
     * - magic points (vote + modifiers)
     * - vote
     */
    interface QuotationInterface {

        /**
         * Returns the id of the footballer associated to the quotation.
         *
         * @return integer
         */
        public function getId();

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