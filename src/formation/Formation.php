<?php

/**
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\FormationInterface as FormationInterface;

    /**
     * @inheritDoc
     */
    class Formation implements FormationInterface {

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
         * A container of footballers
         * @var array
         */
        private $_footballers = array();

        /**
         * @param Footballer[] $footballers
         */
        public function __construct(array $footballers) {
            $this->_footballers = $footballers;
        }

        /**
         * @inheritDoc
         */
        public function getGoalKeeperLabel() {
            return self::GOALKEEPER;
        }

        /**
         * @inheritDoc
         */
        public function getDefenderLabel() {
            return self::DEFENDER;
        }

        /**
         * @inheritDoc
         */
        public function getMidfielderLabel() {
            return self::MIDFIELDER;
        }

        /**
         * @inheritDoc
         */
        public function getForwardLabel() {
            return self::FORWARD;
        }

        /**
         * @inheritDoc
         */
        public function getFirstStrings($role = null) {
            $firstStrings = array();
                foreach ($this->_footballers as $footballer) {
                if ($footballer->isFirstString()) {
                    // Adds the footballer
                    // - if the role is not specified so it means that all footballers have to be taken int account
                    // - if the role matches the one of the footballer
                    if ($role === $footballer->getRole() || is_null($role)) {
                        array_push($firstStrings, $footballer);
                    }
                }
            }
            return $firstStrings;
        }

        /**
         * @inheritDoc
         */
        public function getReserves($role = null) {
            $reserves = array();
            foreach ($this->_footballers as $footballer) {
                if ($footballer->isReserve()) {
                    if ($role === $footballer->getRole() || is_null($role)) {
                        array_push($reserves, $footballer);
                    }
                }
            }
            return $reserves;
        }
    }
}
