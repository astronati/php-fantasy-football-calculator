<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines the interface of a Calculator
 */
interface CalculatorInterface {

  /**
   * Returns the sum of the formation. It is calculated taking into account that there are a number of reserves by each
   * role.
   *
   * @param Array $formation
   * @return float
   */
  public function getSum(array $formation);

  /**
   * Returns the defense bonus of the formation.
   * The defense bonus is calculated using the goalkeeper votes and the ones of the best 3 defenders.
   * To apply this bonus the formation needs to have 4 defenders at least.
   *
   * @param Array $formation
   * @return integer
   */
  public function getDefenseBonus(array $formation);

  /**
   * Returns the entire formation with the vote and the magic points for each footballer.
   *
   * @param Array $formation
   * @return Array
   */
  public function getFormationDetails(array $formation);
}
