<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.0.0
 */

/**
 * Defines the interface of a Conversion Table
 */
interface ConversionTableInterface {

  /**
   * Returns the instance of the ConversationTable.
   * It implements the Singleton pattern.
   *
   * @return ConversationTable
   */
  public static function getInstance();

  /**
   * Returns the team goals from the given magic points.
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
   * @param integer $average
   * @return integer
   */
  public function getDefenseBonus($average);
}
