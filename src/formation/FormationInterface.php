<?php

namespace FFC;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines the interface of a Formation
 */
interface FormationInterface {

  /**
   * Returns only first strings of the formation. These footballers can be filtered by role.
   *
   * @param string $role (Optional)
   * @return Array
   */
  public function getFirstStrings($role = null);

  /**
   * Returns only reserves of the formation. These footballers can be filtered by role.
   *
   * @param string $role (Optional)
   * @return Array
   */
  public function getReserves($role = null);

  /**
   * Returns the label of the goalkeeper.
   *
   * @return string
   */
  public function getGoalKeeperLabel();

  /**
   * Returns the label of the defender.
   *
   * @return string
   */
  public function getDefenderLabel();

  /**
   * Returns the label of the midfielder.
   *
   * @return string
   */
  public function getMidfielderLabel();

  /**
   * Returns the label of the forward.
   *
   * @return string
   */
  public function getForwardLabel();
}
