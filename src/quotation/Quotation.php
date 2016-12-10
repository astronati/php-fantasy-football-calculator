<?php

/**
 * Defines the votes, malus and bonus given from a newspaper after a soccer match day to a footballer
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\QuotationInterface as QuotationInterface;

    /**
     * A quotation allows to return vote and other properties of a footballer after a soccer match.
     * @inheritDoc
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
            'id',
            'magicPoints',
            'vote',
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
         * Checks if the given $config contains all needed properties in order to define a Quotation instance.
         * @param array $config
         * @throws \Exception Missing parameter
         */
        public function __construct(array $config) {
            if (!$this->_checkConfiguration($config)) {
                throw new \Exception ("Missing parameter");
            }

            $this->_id = (int) $config['id'];
            $this->_magicPoints = $config['magicPoints'] === '' ? null : (float) $config['magicPoints'];
            $this->_vote = $config['vote'] === '' ? null : (float) $config['vote'];
        }

        /**
         * Returns the ID of the quotation.
         * @inheritDoc
         */
        public function getId() {
            return $this->_id;
        }

        /**
         * Returns the magic points of the quotation.
         * @inheritDoc
         */
        public function getMagicPoints() {
            return $this->_magicPoints;
        }

        /**
         * Returns the vote of the quotation.
         * @inheritDoc
         */
        public function getVote() {
            return $this->_vote;
        }

        /**
         * Returns the quotation instance as an array.
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
