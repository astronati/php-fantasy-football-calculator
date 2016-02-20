<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Used to get footballer data.
 */
class Footballer implements FootballerInterface {

  /**
   * Checks if the configuration array has all needed parameters.
   *
   * @param array $config
   * @return boolean
   */
  private function _checkConfiguration(array $config) {
    $mandatoryParams = array(
        'id', 'type', 'order', 'role'
    );
    foreach ($mandatoryParams as $param) {
      if (!array_key_exists($param, $config)) {
        return false;
      }
    }
    return true;
  }

  public function __construct(array $config) {
    if (!$this->_checkConfiguration($config)) {
      throw new Exception ("Missing parameter");
    }

    // TODO ...
  }
}
