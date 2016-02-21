<?php

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Used to map a quotation.
 */
class Quotation implements QuotationInterface {

  /**
   * @var integer
   */
  private $_id;

  /**
   * @var float
   */
  private $_magicPoints;

  /**
   * @var float
   */
  private $_vote;

  /**
   * @var Array
   */
  private $_fields = array(
    'id', 'magicPoints', 'vote'
  );

  /**
   * Checks if the configuration array has all needed parameters.
   *
   * @param array $config
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
    $this->_magicPoints = (float) $config['magicPoints'];
    $this->_vote = (float) $config['vote'];
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
  public function getMagicPoints() {
    return $this->_magicPoints;
  }

  /**
   * @inherit
   */
  public function getVote() {
    return $this->_vote;
  }

  /**
   * @inherit
   */
  public function toArray() {
    $quotationArray = array();
    // e.g. ['code', 'player', ...]
    foreach ($this->_fields as $field) {
      // e.g. 'getCode', 'getPlayer'
      $methodName = 'get' . ucfirst($field);
      $quotationArray[$field] = $this->$methodName();
    }

    return $quotationArray;
  }
}
