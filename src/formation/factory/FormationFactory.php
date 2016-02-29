<?php

namespace FFC;

use \FFC\FormationFactoryInterface as FormationFactoryInterface;
use \FFC\Footballer as Footballer;
use \FFC\Formation as Formation;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines a FormationFactory
 */
class FormationFactory implements FormationFactoryInterface {

  /**
   * @inherit
   */
  public function create($container = array()) {
    $footballers = array();

    foreach ($container as $config) {
      array_push($footballers, new Footballer($config));
    }

    return new Formation($footballers);
  }
}
