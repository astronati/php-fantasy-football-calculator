<?php

use \FFC\ConversionTableInterface as ConversionTableInterface;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

  /**
   * Conversion Table is used to map different values like magic points and goals or defense votes ratio and bonus.
   */
  class ConversionTable implements ConversionTableInterface {
  
    /**
     * The instance of the table itself.
     * @var ConversionTable
     */
    private static $instance;
  
    /**
     * A map between magic points and goals.
     * The first value is the minimum value in order to have the second one as goals.
     * @type Array
     */
    private $_goalsRange = array(
      array(120, 10),
      array(114, 9),
      array(108, 8),
      array(102, 7),
      array(96, 6),
      array(90, 5),
      array(84, 4),
      array(78, 3),
      array(72, 2),
      array(66, 1),
    );
  
    /**
     * A map between the defence votes ratio and the bonus.
     * The first value is the minimum value in order to have the second one as bonus.
     * @type Array
     */
    private $_defenseBonusRange = array(
      array(7, 6),
      array(6.5, 3),
      array(6, 1),
    );
  
    /**
     * Returns the appropriate map value from the given one.
     *
     * @param integer $value
     * @param Array $map
     * @return integer
     */
    private function _getValue($value, $map = array()) {
      foreach ($map as $limit) {
        if ($value >= $limit[0]) {
          return $limit[1];
        }
      }
  
      return 0;
    }
  
    /**
     * @inheritDoc
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }
  
    /**
     * @inheritDoc
     */
    public function getGoals($magicPoints) {
      return $this->_getValue($magicPoints, $this->_goalsRange);
    }
  
    /**
     * @inheritDoc
     */
    public function getDefenseBonus($average) {
      return $this->_getValue($average, $this->_defenseBonusRange);
    }
  }
  
}