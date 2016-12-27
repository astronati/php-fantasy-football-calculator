<?php

/**
 * Report Card is used to compare votes and quotations of footballers in order to return the right votes per each
 * footballer.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    /**
     * Defines the interface of a ReportCard.
     */
    interface ReportCardInterface {

        /**
         * Returns an array of details per each footballer.
         *
         * @param Footballer[] $footballers An array of footballers
         * @return array It has the following structure
         * [
         *   footballerID => [
         *     ...
         *   ],
         *   ...
         * ]
         */
        public function getDetails(array $footballers);

        /**
         * Returns the magic points of the given footballers.
         *
         * @param Footballer[] $footballers An array of footballers
         * @return float[]
         */
        public function getMagicPoints(array $footballers);

        /**
         * Returns the votes of the given footballers.
         *
         * @param Footballer[] $footballers An array of footballers
         * @return float[]
         */
        public function getVotes(array $footballers);

    }
}
