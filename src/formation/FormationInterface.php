<?php

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
   * TODO
   */
  public function getFirstStrings($role = null);

  /**
   * TODO
   */
  public function getReserves($role = null);

  /**
   * TODO
   */
  public function getAll();
}
