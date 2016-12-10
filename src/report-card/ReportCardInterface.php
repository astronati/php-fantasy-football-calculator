<?php

/**
 * Report Card is used to compare votes and quotations of footballers in order to return the right votes per each role.
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
         * Returns the instance of the ReportCard.
         * It implements the Singleton pattern.
         *
         * @return ReportCard
         */
        public static function getInstance();

        /**
         * Returns the votes of the footballers that have played.
         * The footballers are filtered by role.
         *
         * @param Quotation[] $quotations An array of Quotation instances
         * @param Footballer[] $firstStrings An array of footballers as first strings
         * @param Footballer[] $reserves An array of footballers as reserves
         * @param boolean $useMagicPoints If true, it returns the magic points of the footballers otherwise their votes.
         * @return float[]
         */
        public function getVotes($quotations, $firstStrings, $reserves, $useMagicPoints = true);
    }
}
