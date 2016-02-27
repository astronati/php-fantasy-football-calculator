<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.0.0
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
  public function getVotes($formation, $role, $useMagicPoints = true) {
    $firstStrings = $formation->getFirstStrings($role);
    $reserves = $formation->getReserves($role);

    $votes = array();
    $reservesIndex = 0;

    for ($i = 0; $i < count($firstStrings); $i++) {
      $isReserveFound = false;
      if ($firstStrings[$i]->getVote()) {
        array_push($votes, $useMagicPoints ? $firstStrings[$i]->getMagicPoints() : $firstStrings[$i]->getVote());
      }
      else {
        for ($k = $reservesIndex; $k < count($reserves) && !$isReserveFound; $k++) {
          if ($reserves[$k]->getVote()) {
            array_push($votes, $useMagicPoints ? $reserves[$k]->getMagicPoints() : $reserves[$k]->getVote());
            $isReserveFound = true;
          }
        }
      }
    }

    return $votes;
  }
}
