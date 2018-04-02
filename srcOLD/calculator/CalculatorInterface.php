<?php

/**
 * The calculator is used to retrieve all info about formation results like:
 * - the total of magic points
 * - the defense bonus
 * - other bonus...
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC
{
    /**
     * Defines the interface of a Calculator.
     */
    interface CalculatorInterface
    {
        /**
         * Returns all bonus/malus of the formation.
         * Bonus or malus can depend by the same formation or by the opponent formation.
         *
         * @see Footballer::_checkConfiguration
         * @param array $footballers A $footballers element is a 'footballer' that to be instantiated needs to satisfy
         * Footballer::_checkConfiguration
         * @param array $opponentFootballers A $otherFootballers element is a 'footballer' that to be instantiated needs
         * to satisfy Footballer::_checkConfiguration
         * @return array All bonus. If a bonus is not allowed, then 0 (zero) will be returned as value.
         */
        public function getBonus(array $footballers, array $opponentFootballers = null);

        /**
         * Returns the entire formation with the vote and the magic points for each footballer.
         *
         * @see Footballer::_checkConfiguration
         * @see Quotation::_checkConfiguration
         * @param array $footballers A $footballers element is a 'footballer' that to be instantiated needs to satisfy
         * Footballer::_checkConfiguration
         * @return array Contains a list of the players (from the given formation) containing all quotations info such
         * as:
         *
         * [
         *  [
         *    id: {number}
         *    magicPoints: {float}
         *    vote: {float}
         *  ]
         * ]
         */
        public function getFormationDetails(array $footballers);

        /**
         * Returns the number of goals associated to the given magic points.
         *
         * @see ConversionTable::$_goalsRange
         * @param float $magicPointsSum The sum of the magic points of the $formation
         * @return integer The number of goals.
         */
        public function getGoals($magicPointsSum);

        /**
         * Returns the sum of the magic points of the footballers of the formation.
         * It is calculated taking into account that there are a number of reserves by each role.
         *
         * @see Footballer::_checkConfiguration
         * @param array $footballers A $footballers element is a 'footballer' that to be instantiated needs to satisfy
         * Footballer::_checkConfiguration
         * @return float The sum of all magic points of the given formation
         */
        public function getSum(array $footballers);
    }
}
