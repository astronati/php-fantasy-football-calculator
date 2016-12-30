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
     * If footballer didn't receive 'vote' and 'magic points' then all fields will be null. Other fields can have not
     * null values only when the footballer receive a 'vote' or 'magic points' at least.
     * @inheritDoc
     */
    class Quotation implements QuotationInterface {

        /**
         * The identifier of the footballer associated to the quotation
         * @var integer
         */
        private $_footballerID;

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
         * Goals bonus of the footballer
         * @var integer
         */
        private $_goal;

        /**
         * Caution malus of the footballer
         * @var float
         */
        private $_caution;

        /**
         * Expulsion malus of the footballer
         * @var integer
         */
        private $_expulsion;

        /**
         * Penalty bonus/malus of the footballer
         * @var float
         */
        private $_penalty;

        /**
         * AutoGoal malus of the footballer
         * @var float
         */
        private $_autoGoal;

        /**
         * Assist bonus of the footballer
         * @var float
         */
        private $_assist;

        /**
         * Needed fields to define a valid quotation
         * @var array
         */
        private $_fields = array(
            'footballerID',
            'magicPoints',
            'vote',
            'goal',
            'caution',
            'expulsion',
            'penalty',
            'autoGoal',
            'assist',
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

            $this->_footballerID = (int) $config['footballerID'];
            $this->_magicPoints = is_null($config['magicPoints']) ? null : (float) $config['magicPoints'];
            $this->_vote = is_null($config['vote']) ? null : (float) $config['vote'];
            $this->_goal = is_null($config['goal']) ? null : (int) $config['goal'];
            $this->_caution = is_null($config['caution']) ? null : (float) $config['caution'];
            $this->_expulsion = is_null($config['expulsion']) ? null : (int) $config['expulsion'];
            $this->_penalty = is_null($config['penalty']) ? null : (int) $config['penalty'];
            $this->_autoGoal = is_null($config['autoGoal']) ? null : (int) $config['autoGoal'];
            $this->_assist = is_null($config['assist']) ? null : (int) $config['assist'];
        }

        /**
         * Returns the ID of the footballer.
         * @inheritDoc
         */
        public function getFootballerId() {
            return $this->_footballerID;
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
         * Returns the goal bonus of the footballer.
         *
         * @return integer
         */
        public function getGoal() {
            return $this->_goal;
        }

        /**
         * Returns the caution malus of the footballer.
         *
         * @return float
         */
        public function getCaution() {
            return $this->_caution;
        }

        /**
         * Returns the expulsion malus of the footballer.
         *
         * @return integer
         */
        public function getExpulsion() {
            return $this->_expulsion;
        }

        /**
         * Returns the penalty bonus/malus of the footballer.
         *
         * @return integer
         */
        public function getPenalty() {
            return $this->_penalty;
        }

        /**
         * Returns the auto goal malus of the footballer.
         *
         * @return integer
         */
        public function getAutoGoal() {
            return $this->_autoGoal;
        }

        /**
         * Returns the assist bonus of the footballer.
         *
         * @return integer
         */
        public function getAssist() {
            return $this->_assist;
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
