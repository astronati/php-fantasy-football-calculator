<?php

use \FFC\ReportCardInterface as ReportCardInterface;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

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
     * @private
     * @description This method is used to return the generic vote of the footballer.
     * As described in the getVotes method it could happen that a footballer has magic points only. This happens when
     * a match is not played and the newspaper assigns a 6 by default.
     */
    private function _getVote($quotation) {
      return $quotation->getVote() ? $quotation->getVote() : $quotation->getMagicPoints();
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
    public function getVotes($formation, $quotations, $role, $useMagicPoints = true) {
      $firstStrings = $formation->getFirstStrings($role);
      $reserves = $formation->getReserves($role);
  
      $votes = array();
      $reservesIndex = 0;
  
      for ($i = 0; $i < count($firstStrings); $i++) {
        $isReserveFound = false;
        $firstStringQuotation = $quotations[$firstStrings[$i]->getId()];
        // Could happen that there isn't vote but there are the magic points.
        // This because when a match is not played, the newspaper assign a 6 by default to all those footballers that
        // were included in that match.
        if ($firstStringQuotation->getVote() || $firstStringQuotation->getMagicPoints()) {
          array_push($votes, $useMagicPoints ? $firstStringQuotation->getMagicPoints() : $this->_getVote($firstStringQuotation));
        }
        else {
          for ($k = $reservesIndex; $k < count($reserves) && !$isReserveFound; $k++) {
            $reserveQuotation = $quotations[$reserves[$k]->getId()];
            if ($reserveQuotation->getVote() || $reserveQuotation->getMagicPoints()) {
              array_push($votes, $useMagicPoints ? $reserveQuotation->getMagicPoints() : $this->_getVote($reserveQuotation));
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
