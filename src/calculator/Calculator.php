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
  private $_conversionTable;

  /**
   * @var Object
   */
  private $_reportCard;

  /**
   * Determines if the defense bonus options is usable or not.
   *
   * @return boolean
   */
  private function _isDefenseBonusAvailable() {
    return (bool) (array_key_exists('defenseBonus', $this->_options) && $this->_options['defenseBonus']);
  }

  /**
   * @param Array $quotations
   * @param Array $options It can have following options:
   * - defenseBonus Boolean - Default false
   * @param FormationFactory $formationFactory
   * @param QuotationFactory $quotationFactory
   * @param ConversionTable $conversionTable
   * @param ReportCard $reportCard
   */
  public function __construct(array $quotations, array $options = array(), $formationFactory, $quotationFactory, $conversionTable, $reportCard) {
    for ($i = 0; $i < count($quotations); $i++) {
      $quotation = $quotationFactory->create($quotations[$i]);
      $this->_quotations[$quotation->getId()] = $quotation;
    }

    $this->_options = $options;
    $this->_formationFactory = $formationFactory;
    $this->_conversionTable = $conversionTable;
    $this->_reportCard = $reportCard;
  }

  /**
   * @inherit
   */
  public function getSum(array $footballers) {
    $formation = $this->_formationFactory->create($footballers);

    return array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getGoalKeeperLabel())) +
      array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getDefenderLabel())) +
      array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getMidfielderLabel())) +
      array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getForwardLabel()));
  }

  /**
   * @inherit
   */
  public function getDefenseBonus(array $footballers) {
    $formation = $this->_formationFactory->create($footballers);
    $ratio = 0;

    if ($this->_isDefenseBonusAvailable()
        && count($formation->getFirstStrings($formation->getDefenderLabel())) >= 4) {

      $goalkeeperVote = $this->_reportCard->getVotes($formation, $this->_quotations, $formation->getGoalKeeperLabel());
      $defenderVotes = $this->_reportCard->getVotes($formation, $this->_quotations, $formation->getDefenderLabel(), true);

      // Oder from high to low by value
      rsort($defenderVotes);

      // Take three footballers with the highest vote and sum them
      $threeBestDefendersVotes = array_slice($defenderVotes, 0, 3);

      // Sum the goalkeeper and defenders votes and divide the result by 4
      $ratio = ($goalkeeperVote[0] + array_sum($threeBestDefendersVotes)) / 4;
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
