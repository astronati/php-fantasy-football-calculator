<?php

// TODO Should be converted into a class with state, since it should save quotations

/**
 * Report Card allows to compare votes and quotations of footballers in order to return the right votes per each role.
 *
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
         * This method is used to return the generic vote of the footballer.
         * As described in the getVotes method it could happen that a footballer has magic points only. This happens
         * when a match is not played and the newspaper assigns a 6 by default.
         * @param Quotation $quotation
         * @param boolean $useMagicPoints
         * @return float
         * @private
         */
        private function _getVote($quotation, $useMagicPoints) {
            return $useMagicPoints || !$quotation->getVote() ? $quotation->getMagicPoints() : $quotation->getVote();
        }

        /**
         * Returns the instance of the class.
         * @inheritDoc
         * @return ReportCard
         */
        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Returns an array containing the votes of those players that have to been taken into account as players who
         * played in the given formation.
         * @inheritDoc
         * @param Quotation[] $quotations
         * @param Footballer[] $firstStrings
         * @param Footballer[] $reserves
         * @param boolean $useMagicPoints True by default
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
