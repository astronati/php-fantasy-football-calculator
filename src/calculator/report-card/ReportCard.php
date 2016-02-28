<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines a ReportCard
 */
class ReportCard implements ReportCardInterface {

  /**
   * @var ReportCard
   */
  private static $instance;

  /**
   * Returns an instance of this class.
   *
   * @return ReportCard
   */
  public static function getInstance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * @inherit
   */
  public function getVotes($formation, $quotations, $role, $useMagicPoints = true) {
    $firstStrings = $formation->getFirstStrings($role);
    $reserves = $formation->getReserves($role);

    $votes = array();
    $reservesIndex = 0;

    for ($i = 0; $i < count($firstStrings); $i++) {
      $isReserveFound = false;
      $firstStringQuotation = $quotations[$firstStrings[$i]->getId()];
      if ($firstStringQuotation->getVote()) {
        array_push($votes, $useMagicPoints ? $firstStringQuotation->getMagicPoints() : $firstStringQuotation->getVote());
      }
      else {
        for ($k = $reservesIndex; $k < count($reserves) && !$isReserveFound; $k++) {
          $reserveQuotation = $quotations[$reserves[$k]->getId()];
          if ($reserveQuotation->getVote()) {
            array_push($votes, $useMagicPoints ? $reserveQuotation->getMagicPoints() : $reserveQuotation->getVote());
            $isReserveFound = true;
          }
        }
      }
    }

    return $votes;
  }
}
