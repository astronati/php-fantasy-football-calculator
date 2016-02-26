<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.0.0
 */

/**
 * Used to calc the total of a fantasy football formation.
 */
class Calculator implements CalculatorInterface {

  /**
   * A container of all footballer quotations of the match day
   * @var Array
   */
  private $_quotations = array();

  /**
   * A container for all calculator options
   * @var Array
   */
  private $_options;

  /**
   * @var Object
   */
  private $_formationFactory;

  /**
   * @var Object
   */
  private $_quotationFactory;

  /**
   * @var Object
   */
  private $_conversionTable;

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
   * TODO
   */
  private function _isDefenseBonusAvailable() {
    return array_key_exists('defenseBonus', $this->_options) && $this->_options['defenseBonus'];
  }

  /**
   * @param Array $quotations
   * @param Array $options It can have following options:
   * - defenseBonus Boolean - Default false
   * @param FormationFactory $formationFactory
   * @param QuotationFactory $quotationFactory
   * @param Object $conversionTable
   */
  public function __construct(array $quotations, array $options = array(), $formationFactory, $quotationFactory, $conversionTable) {
    for ($i = 0; $i < count($quotations); $i++) {
      $quotation = $quotationFactory->create($quotations[$i]);
      $this->_quotations[$quotation->getId()] = $quotation;
    }

    $this->_options = $options;
    $this->_formationFactory = $formationFactory;
    $this->_quotationFactory = $quotationFactory;
    $this->_conversionTable = $conversionTable;
  }

  /**
   * @inherit
   */
  public function getSum(array $footballers) {
    $formation = $this->_formationFactory->create($footballers);

    return array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::GOALKEEPER),
      $formation->getReserves(Formation::GOALKEEPER)
    )) +
    array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::DEFENDER),
      $formation->getReserves(Formation::DEFENDER)
    )) +
    array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::MIDFIELDER),
      $formation->getReserves(Formation::MIDFIELDER)
    )) +
    array_sum($this->_getVotesByRole(
      $formation->getFirstStrings(Formation::FORWARD),
      $formation->getReserves(Formation::FORWARD)
    ));
  }

  /**
   * @inherit
   */
  public function getDefenseBonus(array $footballers) {
    $formation = $this->_formationFactory->create($footballers);
    $ratio = 0;

    if (count($formation->getFirstStrings(Formation::DEFENDER))
        && $this->_isDefenseBonusAvailable()) {
      $goalkeeperVote = array_sum($this->_getVotesByRole(
        $formation->getFirstStrings(Formation::GOALKEEPER),
        $formation->getReserves(Formation::GOALKEEPER)
      ));

      $defenderVotes = $this->_getVotesByRole(
        $formation->getFirstStrings(Formation::DEFENDER),
        $formation->getReserves(Formation::DEFENDER),
        true
      );

      // Oder from high to low by value
      rsort($defenderVotes);

      // Take three footballers with the highest vote
      $defenderSum = array_sum(
        array_slice($defenderVotes, 0, 3)
      );

      // Sum the goalkeeper and defenders votes and divide the result by 4
      $ratio = ($goalkeeperVote + $defenderSum) / 4;
    }

    return $this->_conversionTable->getDefenseBonus($ratio);
  }

  /**
   * @inherit
   */
  public function getFormationDetails(array $footballers) {
    $formation = $this->_formationFactory->create($footballers);
    $allFootballers = array_merge($formation->getFirstStrings(), $formation->getReserves());

    $details = array();
    for ($i = 0; $i < count($allFootballers); $i++) {
      array_push($details, $this->_quotations[$allFootballers[$i]->getId()]->toArray());
    }

    return $details;
  }
}
