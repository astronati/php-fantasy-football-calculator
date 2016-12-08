<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ReportCardInterface as ReportCardInterface;

    /**
     * Defines a ReportCard.
     * Report Card is used to return the votes of the footballers that have played in terms of fantasy team.
     */
    class ReportCard implements ReportCardInterface {

        /**
         * The instance of the class itself.
         * @var ReportCard
         */
        private static $instance;

        /**
         * @param Quotation $quotation
         * @param boolean $useMagicPoints
         * @return float
         * @private
         * @description This method is used to return the generic vote of the footballer.
         * As described in the getVotes method it could happen that a footballer has magic points only. This happens
         * when a match is not played and the newspaper assigns a 6 by default.
         */
        private function _getVote($quotation, $useMagicPoints) {
            return $useMagicPoints || !$quotation->getVote() ? $quotation->getMagicPoints() : $quotation->getVote();
        }

        /**
         * @inheritDoc
         */
        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * @inheritDoc
         */
        public function getVotes($quotations, $firstStrings, $reserves, $useMagicPoints = true) {
            $votes = array();
            $reservesIndex = 0;

            for ($i = 0; $i < count($firstStrings); $i++) {
                $isReserveFound = false;
                $firstStringQuotation = $quotations[$firstStrings[$i]->getId()];
                $vote = $this->_getVote($firstStringQuotation, $useMagicPoints);
                if (!is_null($vote)) {
                    array_push($votes, $vote);
                }
                else {
                    // Iterates between available reserves
                    for ($k = $reservesIndex; $k < count($reserves) && !$isReserveFound; $k++) {
                        $reserveQuotation = $quotations[$reserves[$k]->getId()];
                        $vote = $this->_getVote($reserveQuotation, $useMagicPoints);
                        if (!is_null($vote)) {
                            array_push($votes, $vote);
                            $isReserveFound = true;
                            // Next round starts from the next reserve
                            $reservesIndex++;
                        }
                    }
                }
            }

            return $votes;
        }
    }
}
