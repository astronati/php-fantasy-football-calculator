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
   * @var string
   */
  const FIRST_STRING = 'T';

  /**
   * @var string
   */
  const RESERVE = 'R';

  /**
   * @var integer
   */
  private $_id;

  /**
   * @var string
   */
  private $_type;

  /**
   * @type string
   */
  private $_role;

  /**
   * @var Array
   */
  private $_fields = array(
    'id', 'type', 'order', 'role'
  );

  /**
   * Checks if the configuration array has all needed parameters.
   *
   * @param Array $config
   * @return boolean
   */
  private function _checkConfiguration(array $config) {
    foreach ($this->_fields as $param) {
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
    $this->_role = (string) $config['role'];
  }

  /**
   * @inherit
   */
  public function getId() {
    return $this->_id;
  }

  /**
   * @inherit
   */
  public function getRole() {
    return $this->_role;
  }

  /**
   * @inherit
   */
  public function isFirstString() {
    return $this->_type === self::FIRST_STRING;
  }

  /**
   * @inherit
   */
  public function isReserve() {
    return $this->_type === self::RESERVE;
  }
}
