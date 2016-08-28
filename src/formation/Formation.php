<?php

use \FFC\FormationInterface as FormationInterface;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

namespace FFC {

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
      $this->_footballers = $footballers;
    }
  
    /**
     * @inherit
     */
    public function getGoalKeeperLabel() {
      return self::GOALKEEPER;
    }
  
    /**
     * @inherit
     */
    public function getDefenderLabel() {
      return self::DEFENDER;
    }
  
    /**
     * @inherit
     */
    public function getMidfielderLabel() {
      return self::MIDFIELDER;
    }
  
    /**
     * @inherit
     */
    public function getForwardLabel() {
      return self::FORWARD;
    }
  
    /**
     * @inherit
     */
    public function getFirstStrings($role = null) {
      $firstStrings = array();
      foreach ($this->_footballers as $footballer) {
        if ($footballer->isFirstString()) {
          if ($role === $footballer->getRole() || is_null($role)) {
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
          if ($role === $footballer->getRole() || is_null($role)) {
            array_push($reserves, $footballer);
          }
        }
      }
      return $reserves;
    }
  }
  
}
