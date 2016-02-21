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
   * @var string
   */
  const GOALKEEPER = 'P';

  /**
   * @var string
   */
  const DEFENDER = 'D';

  /**
   * @var string
   */
  const MIDFIELDER = 'C';

  /**
   * @var string
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
   * @inherit
   */
  public function getFirstStrings($role = null) {
    $firstStrings = array();
    foreach ($this->_footballers as $footballer) {
      if ($footballer->isFirstString()) {
        if ($role) {
          if ($role === $footballer->getRole()) {
            array_push($firstStrings, $footballer);
          }
        }
        else {
          array_push($firstStrings, $footballer);
        }
      }
    }
    return $firstStrings;
  }

  /**
   * @inherit
   */
  public function getReserves($role = null) {
    $reserves = array();
    foreach ($this->_footballers as $footballer) {
      if ($footballer->isReserve()) {
        if ($role) {
          if ($role === $footballer->getRole()) {
            array_push($reserves, $footballer);
          }
        }
        else {
          array_push($reserves, $footballer);
        }
      }
    }
    return $reserves;
  }

  /**
   * @inherit
   */
  public function getAll() {
    return array_merge($this->getFirstStrings(), $this->getReserves());
  }
}
