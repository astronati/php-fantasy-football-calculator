<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Used to calc the total of a fantasy football formation.
 */
class Calculator implements CalculatorInterface {

  /**
   * A container of all footballer quotations of the match day
   * @var Array
   */
  private $_quotations;

  /**
   * A container for all calculator settings
   * @var Array
   */
  private $_settings;

  /**
   * @param Array $firstStrings
   * @param Array $reserves
   * @param boolean $isJustVote
   * @return Array
   */
  private function _getVotesByRole(array $firstStrings, array $reserves = array(), $isJustVote = false) {
    $votes = array();
    $reservesIndex = 0;
    for ($i = 0; $i < count($firstStrings); $i++) {
      $isReserveFound = false;
      if ($firstStrings[$i]->getVote()) {
        array_push($votes, $isJustVote ? $firstStrings[$i]->getVote() : $firstStrings[$i]->getMagicPoints());
      }
      else {
        for ($k = $reservesIndex; $k < count($reserves) && !$isReserveFound; $k++) {
          if ($reserves[$k]->getVote()) {
            array_push($votes, $isJustVote ? $reserves[$k]->getVote() : $reserves[$k]->getMagicPoints());
            $isReserveFound = true;
          }
        }
      }
    }

    return $votes;
  }

  /**
   * @param Array $quotations
   * @param Array $options It can have following options:
   * - defenseBonus Boolean - Default false
   */
  public function __construct(array $quotations, array $options = array()) {
    for ($i = 0; $i < count($quotations); $i++) {
      array_push($this->_quotations, new Quotation($quotations[$i]));
    }

    $this->_settings = $options;
  }

  /**
   * @inherit
   */
  public function getSum(array $footballers) {
    $formation = new Formation($footballers);

    $sum = 0;
    $sum += array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::GOALKEEPER),
      $formation->getReserves(Formation::GOALKEEPER)
    ));
    $sum += array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::DEFENDER),
      $formation->getReserves(Formation::DEFENDER)
    ));
    $sum += array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::MIDFIELDER),
      $formation->getReserves(Formation::MIDFIELDER)
    ));
    $sum += array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::FORWARD),
      $formation->getReserves(Formation::FORWARD)
    ));
  }

  /**
   * @inherit
   */
  public function getDefenseBonus(array $footballers) {
    $formation = new Formation($footballers);

    if (count($formation->getFirstStrings(Formation::DEFENDER))) {
      $goalkeeperSum = array_sum($this->_getVotesByRole(
        $formation->getFirstStrings(Formation::GOALKEEPER),
        $formation->getReserves(Formation::GOALKEEPER)
      ));

      $defenderVotes = $this->_getVotesByRole(
        $formation->getFirstStrings(Formation::DEFENDER),
        $formation->getReserves(Formation::DEFENDER),
        true
      );

      rsort($defenderVotes);

      $defenderSum = array_sum(
        array_slice($defenderVotes, 0, 3)
      );

      $ratio = ($goalkeeperSum + $defenderSum) / 4;

      if ($ratio >= 7) {
        return 6;
      }

      if ($ratio >= 6.5) {
        return 3;
      }

      if ($ratio >= 6) {
        return 1;
      }
    }

    return 0;
  }

  /**
   * TODO
   */
  public function getFootballers(array $footballers) {
    $formation = new Formation($footballers);

    // TODO Should retunr footballers with values and if they have been taken into account
  }
}
