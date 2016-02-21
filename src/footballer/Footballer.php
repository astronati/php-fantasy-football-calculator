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
   * @var integer
   */
  private $_id;

  /**
   * @type string
   */
  private $_type;

  /**
   * @type integer
   */
  private $_order;

  /**
   * @type string
   */
  private $_role;

  /**
   * Checks if the configuration array has all needed parameters.
   *
   * @param Array $config
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

  /**
   * @param Array $config
   * @throws Exception Missing parameter
   */
  public function __construct(array $config) {
    if (!$this->_checkConfiguration($config)) {
      throw new Exception ("Missing parameter");
    }

    $this->_id = (int) $config['id'];
    $this->_type = (string) $config['type'];
    $this->_order = (int) $config['order'];
    $this->_role = (string) $config['role'];
  }

  /**
   * TODO
   */
  public function getId() {}

  /**
   * TODO
   */
  public function getType() {}

  /**
   * TODO
   */
  public function getOrder() {}

  /**
   * TODO
   */
  public function getRole() {}
}
