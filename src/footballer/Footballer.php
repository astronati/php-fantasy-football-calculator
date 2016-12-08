<?php

/**
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\FootballerInterface as FootballerInterface;

    /**
     * @inheritDoc
     */
    class Footballer implements FootballerInterface {

        /**
         * Used to determine if the footballers started the match between 11 first players
         * @var string
         */
        const FIRST_STRING = 'T';

        /**
         * Used to determine if the footballer started the match in the bleachers.
         * @var string
         */
        const RESERVE = 'R';

        /**
         * @var string
         */
        const GOALKEEPER = 'P';

        /**
         * @var string
         */
        const DEFENDER = 'D';

        /**
         * @var string
         */
        const MIDFIELDER = 'C';

        /**
         * @var string
         */
        const FORWARD = 'A';

        /**
         * A unique integer number to identify the footballer
         * @var integer
         */
        private $_id;

        /**
         * First string or reserve
         * @see Footballer::FIRST_STRING
         * @see Footballer::RESERVE
         * @var string
         */
        private $_type;

        /**
         * @type string
         */
        private $_role;

        /**
         * @var array
         */
        private $_fields = array(
            'id',
            'type',
            'order',
            'role',
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
            $this->_type = (string) $config['type'];
            $this->_role = (string) $config['role'];
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
        public function isFirstString() {
            return $this->_type === self::FIRST_STRING;
        }

        /**
         * @inheritDoc
         */
        public function isReserve() {
            return $this->_type === self::RESERVE;
        }

        /**
         * @inheritDoc
         */
        public function isGoalkeeper() {
            return $this->_role === self::GOALKEEPER;
        }

        /**
         * @inheritDoc
         */
        public function isDefender() {
            return $this->_role === self::DEFENDER;
        }

        /**
         * @inheritDoc
         */
        public function isMidfielder() {
            return $this->_role === self::MIDFIELDER;
        }

        /**
         * @inheritDoc
         */
        public function isForward() {
            return $this->_role === self::FORWARD;
        }
    }
}
