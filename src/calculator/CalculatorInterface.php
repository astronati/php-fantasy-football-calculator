<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

  /**
   * Defines the interface of a Calculator.
   * The calculator is used to retrieve all info about formation results like the total of magic points or the defense
   * bonus.
   */
  interface CalculatorInterface {
  
    /**
     * Returns the sum of the magic points of the footballers of the formation.
     * It is calculated taking into account that there are a number of reserves by each role.
     *
     * @see Footballer::_checkConfiguration
     * @param array $footballers A $footballers element is a 'footballer' that to be instantiated needs to satisfy
     * Footballer::_checkConfiguration
     * @return float The sum of all magic points of the given formation
     */
    public function getSum(array $footballers);
  
    /**
     * Returns the defense bonus of the formation.
     * The defense bonus is calculated using the goalkeeper votes and the ones of the best 3 defenders.
     * To apply this bonus the formation needs to have 4 defenders at least.
     *
     * @see Footballer::_checkConfiguration
     * @param array $formation A $formation element is a 'footballer' that to be instantiated needs to satisfy
     * Footballer::_checkConfiguration
     * @return integer The defense bonus if allowed.
     */
    public function getDefenseBonus(array $formation);
  
    /**
     * Returns the entire formation with the vote and the magic points for each footballer.
     *
     * @see Footballer::_checkConfiguration
     * @see Quotation::_checkConfiguration
     * @param array $formation A $formation element is a 'footballer' that to be instantiated needs to satisfy
     * Footballer::_checkConfiguration
     * @return array Contains a list of the players (from the given formation) containing all quotations info such as:
     * [
     *  [
     *    id: {number}
     *    magicPoints: {float}
     *    vote: {float}
     *  ]
     * ]
     */
    public function getFormationDetails(array $formation);

    /**
     * Returns the number of goals associated to the given magic points.
     *
     * @see ConversionTable::$_goalsRange
     * @param float $magicPoints The sum of the magic points of the $formation
     * @return integer The number of goals.
     */
    public function getGoals($magicPoints);
  }
  
}
