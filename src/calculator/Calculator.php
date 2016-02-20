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
  public function calc(array $formation) {
    $formation = new Formation($formation);

    $sum = $formation->getSum();

    if ($this->_settings['defenseBonus']) {
      $sum += $formation->getDefenseBonus();
    }

    return $sum;
  }
}
