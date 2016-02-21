<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines the interface of the Footballer Factory
 */
interface FootballerFactoryInterface {

  /**
   * Returns a new instance of the Footballer class
   *
   * @param Array $config
   * @return Footballer
   */
  public function create($config = array());
}
