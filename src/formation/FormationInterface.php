<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.0.0
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
}
