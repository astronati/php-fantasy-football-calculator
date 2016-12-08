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
         * A container of all formation footballers
         * @var array
         */
        private $_footballers = array();

        /**
         * A container of (filtered) footballers
         * @var array
         */
        private $_filteredFootballers = array();

        /**
         * Filters footballer by given method to apply on the Footballer instance.
         *
         * @param string $footballerMethod The method of the Footballer instance. It should return a boolean
         */
        private function _filter($footballerMethod) {
            $footballers = $this->_getFilteredFootballers();

            $filteredFootballers = array();
            foreach ($footballers as $footballer) {
                if ($footballer->$footballerMethod()) {
                    array_push($filteredFootballers, $footballer);
                }
            }
            $this->_filteredFootballers = $filteredFootballers;
        }

        /**
         * Gets all footballers of the formation or a subset if it has been filtered
         *
         * @return array
         */
        private function _getFilteredFootballers() {
            return !empty($this->_filteredFootballers) ? $this->_filteredFootballers : $this->_footballers;
        }

        /**
         * @param Footballer[] $footballers
         */
        public function __construct(array $footballers) {
            $this->_footballers = $footballers;
        }

        /**
         * @inheritDoc
         */
        public function filterFirstStrings() {
            $this->_filter('isFirstString');
            return $this;
        }

        /**
         * @inheritDoc
         */
        public function filterReserves() {
            $this->_filter('isReserve');
            return $this;
        }

        /**
         * @inheritDoc
         */
        public function filterGoalkeepers() {
            $this->_filter('isGoalkeeper');
            return $this;
        }

        /**
         * @inheritDoc
         */
        public function filterDefenders() {
            $this->_filter('isDefender');
            return $this;
        }

        /**
         * @inheritDoc
         */
        public function filterMidfielders() {
            $this->_filter('isMidfielder');
            return $this;
        }

        /**
         * @inheritDoc
         */
        public function filterForwards() {
            $this->_filter('isForward');
            return $this;
        }

        /**
         * @inheritDoc
         */
        public function getFootballers() {
            $footballers = $this->_getFilteredFootballers();
            $this->_filteredFootballers = array();
            return $footballers;
        }
    }
}
