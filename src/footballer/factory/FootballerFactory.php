<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines a FootballerFactory
 */
class FootballerFactory implements FootballerFactoryInterface {

  /**
   * @inherit
   */
  public function create($config = array()) {
    return new Footballer($config);
  }
}
