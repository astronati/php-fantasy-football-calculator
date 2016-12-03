<?php

use \FFC\QuotationInterface as QuotationInterface;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

  /**
   * Used to map a quotation.
   */
  class Quotation implements QuotationInterface {
  
    /**
     * The identifier of the quotation
     * @var integer
     */
    private $_id;

    /**
     * Magic points of the footballer
     * @var float
     */
    private $_magicPoints;
  
    /**
     * Vote (magic points without bonus/malus) of the footballer
     * @var float
     */
    private $_vote;
  
    /**
     * Needed fields to define a valid quotation
     * @var array
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
     * @param array $config
     * @throws \Exception Missing parameter
     */
    public function __construct(array $config) {
      if (!$this->_checkConfiguration($config)) {
        throw new \Exception ("Missing parameter");
      }
  
      $this->_id = (int) $config['id'];
      $this->_magicPoints = (float) $config['magicPoints'];
      $this->_vote = (float) $config['vote'];
    }
  
    /**
     * @inheritDoc
     */
    public function getId() {
      return $this->_id;
    }
  
    /**
     * @inheritDoc
     */
    public function getMagicPoints() {
      return $this->_magicPoints;
    }
  
    /**
     * @inheritDoc
     */
    public function getVote() {
      return $this->_vote;
    }
  
    /**
     * @inheritDoc
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
}
