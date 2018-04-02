<?php

/**
 * A Formation is a group of Footballers
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    use \FFC\FormationInterface as FormationInterface;

    /**
     * Allows to return footballers and to filter them by type (first strings or reserves) or by role (goalkeeper,
     * defender, midfielder and forward)
     * @inheritDoc
     */
    class Formation implements FormationInterface {

        /**
         * A container of all formation footballers
         * @var array
         */
        private $_footballers = [];

        /**
         * A container of (filtered) footballers
         * @var array
         */
        private $_filteredFootballers = [];

        /**
         * Filters footballer by given method to apply on the Footballer instance.
         *
         * @param string $footballerMethod The method of the Footballer instance. It should return a boolean
         */
        private function _filter($footballerMethod) {
            $footballers = $this->_getFilteredFootballers();

            $filteredFootballers = [];
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
         * Adds footballers to the instance.
         * @param Footballer[] $footballers
         */
        public function __construct(array $footballers) {
            $this->_footballers = $footballers;
        }

        /**
         * Filters filtered footballers or all of them by type as first strings.
         * @inheritDoc
         */
        public function filterFirstStrings() {
            $this->_filter('isFirstString');
            return $this;
        }

        /**
         * Filters filtered footballers or all of them by type as reserves.
         * @inheritDoc
         */
        public function filterReserves() {
            $this->_filter('isReserve');
            return $this;
        }

        /**
         * Filters filtered footballers or all of them by role as goalkeeper.
         * @inheritDoc
         */
        public function filterGoalkeepers() {
            $this->_filter('isGoalkeeper');
            return $this;
        }

        /**
         * Filters filtered footballers or all of them by role as defenders.
         * @inheritDoc
         */
        public function filterDefenders() {
            $this->_filter('isDefender');
            return $this;
        }

        /**
         * Filters filtered footballers or all of them by role as midfielders.
         * @inheritDoc
         */
        public function filterMidfielders() {
            $this->_filter('isMidfielder');
            return $this;
        }

        /**
         * Filters filtered footballers or all of them by role as forwards.
         * @inheritDoc
         */
        public function filterForwards() {
            $this->_filter('isForward');
            return $this;
        }

        /**
         * Returns all footballers or the filtered ones.
         * @inheritDoc
         * @return Footballer[]
         */
        public function getFootballers() {
            $footballers = $this->_getFilteredFootballers();
            $this->_filteredFootballers = [];
            return $footballers;
        }
    }
}
