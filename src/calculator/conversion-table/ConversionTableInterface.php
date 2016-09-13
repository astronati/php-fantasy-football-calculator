<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

  /**
   * Defines the interface of a Conversion Table.
   * Conversion Table is used to map different values like magic points and goals or defense votes ratio and bonus.
   */
  interface ConversionTableInterface {
  
    /**
     * Returns the instance of the ConversionTable.
     * It implements the Singleton pattern.
     *
     * @return ConversionTable
     */
    public static function getInstance();
  
    /**
     * Returns the relative team goals from the given magic points.
     *
     * @param integer $magicPoints
     * @return integer
     */
    public function getGoals($magicPoints);
  
    /**
     * Returns the defense bonus from the given average value.
     * The value is an average between the goalkeeper vote and the 3 best votes of the defenders that have played.
     * NOTE: Defense Bonus can be applied just if 4 or more defenders have been lined up.
     *
     * @param integer $ratio
     * @return integer
     */
    public function getDefenseBonus($ratio);
  }

}
