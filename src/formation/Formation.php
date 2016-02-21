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
   * TODO
   */
  const GOALKEEPER = 'P';

  /**
   * TODO
   */
  const DEFENDER = 'D';

  /**
   * TODO
   */
  const MIDFIELDER = 'C';

  /**
   * TODO
   */
  const FORWARD = 'A';

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
  public function getFirstStrings($role = null) {
    // TODO
  }

  /**
   * TODO
   */
  public function getReserves($role = null) {
    // TODO
  }
}
