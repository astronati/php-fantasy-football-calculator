<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Used to map a soccer formation.
 */
class Formation implements FormationInterface {

  /**
   * A container of footballers
   * @var Array
   */
  private $_footballers = array();

  /**
   * @param Array $footballers
   */
  public function __construct(array $footballers) {
    for ($i = 0; $i < count($footballers); $i++) {
      array_push($this->_footballers, new Footballer($footballers[$i]));
    }
  }

  /**
   * TODO
   */
  public function getSum() {
    // TODO Get portiere sum
    // TODO Get difensore sum
    // TODO Get centrocampisti sum
    // TODO Get attaccanti sum
  }

  /**
   * TODO
   */
  public function getDefenseBonus() {
    // TODO Se e solo se difensori > 3
    // TODO Get portiere sum
    // TODO Get best 3 difensori sum
  }
}
