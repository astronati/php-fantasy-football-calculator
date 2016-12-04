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
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\CalculatorInterface as CalculatorInterface;

    /**
     * Used to calculate results of a fantasy football formation.
     */
    class Calculator implements CalculatorInterface {

        /**
         * A container of all footballers quotations of the match day.
         * @var Quotation[]
         */
        private $_quotations = array();

        /**
         * A container for all calculator options.
         * Available keys:
         * - 'defenseBonus' boolean
         * @var array
         */
        private $_options;

        /**
         * An instance of the FormationFactory.
         * @var FormationFactory
         */
        private $_formationFactory;

        /**
         * An instance of the ConversionTable.
         * @var ConversionTable
         */
        private $_conversionTable;

        /**
         * An instance of the ReportCard.
         * @var ReportCard
         */
        private $_reportCard;

        /**
         * Determines if the defense bonus options is allowed or not.
         *
         * @return boolean True if the defense bonus can be used
         */
        private function _isDefenseBonusAllowed() {
            return (bool) (array_key_exists('defenseBonus', $this->_options) && $this->_options['defenseBonus']);
        }

        /**
         * Returns a new instance of Calculator. To define a new instance, a list of quotations is needed.
         * Optionally it can be configured to calculate bonus.
         * @see Calculator::$_options
         * @see Quotation::_checkConfiguration
         * @param array $quotations Contains arrays with properties that satisfy Quotation::_checkConfiguration
         * @param array $options Contains properties as mentioned in Calculator::$_options
         * @param FormationFactory $formationFactory An instance of FormationFactory
         * @param QuotationFactory $quotationFactory An instance of QuotationFactory
         * @param ConversionTable $conversionTable An instance of ConversionTable
         * @param ReportCard $reportCard An instance of ReportCard
         */
        public function __construct(
            array $quotations,
            array $options = array(),
            FormationFactory $formationFactory,
            QuotationFactory $quotationFactory,
            ConversionTable $conversionTable,
            ReportCard $reportCard
        ) {
            for ($i = 0; $i < count($quotations); $i++) {
                $quotation = $quotationFactory->create($quotations[$i]);
                // Fills $this->_quotations with Quotation instances
                $this->_quotations[$quotation->getId()] = $quotation;
            }

            $this->_options = $options;
            $this->_formationFactory = $formationFactory;
            $this->_conversionTable = $conversionTable;
            $this->_reportCard = $reportCard;
        }

        /**
         * Returns the sum of the magic points of the footballers of the formation.
         * It is calculated taking into account that there are a number of reserves by each role.
         *
         * @inheritDoc
         * @param array $footballers A list of array containing needed data to instantiate a Footballer
         * @return float The sum of points of the team keeping into account only 11 playing footballers.
         */
        public function getSum(array $footballers) {
            $formation = $this->_formationFactory->create($footballers);

            return array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getGoalKeeperLabel())) +
                array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getDefenderLabel())) +
                array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getMidfielderLabel())) +
                array_sum($this->_reportCard->getVotes($formation, $this->_quotations, $formation->getForwardLabel()));
        }

        /**
         * Returns the defense bonus of the formation.
         * The defense bonus is calculated using the goalkeeper votes and the ones of the best 3 defenders.
         * To apply this bonus the formation needs to have 4 defenders at least.
         *
         * @inheritDoc
         * @param array $footballers A $footballers element is a 'footballer' that to be instantiated needs to satisfy
         * Footballer::_checkConfiguration
         * @return integer The defense bonus if allowed.
         */
        public function getDefenseBonus(array $footballers) {
            $formation = $this->_formationFactory->create($footballers);
            $ratio = 0;

            if ($this->_isDefenseBonusAllowed()
                    && count($formation->getFirstStrings($formation->getDefenderLabel())) >= 4) {
                $goalkeeperVote = $this->_reportCard->getVotes($formation, $this->_quotations, $formation->getGoalKeeperLabel(), false);
                $defenderVotes = $this->_reportCard->getVotes($formation, $this->_quotations, $formation->getDefenderLabel(), false);

                // Orders from the highest value to the lowest one
                rsort($defenderVotes);

                // Takes three footballers with the highest vote and sum them
                $threeBestDefendersVotes = array_slice($defenderVotes, 0, 3);

                // Sums the goalkeeper and defenders votes and divide the result by 4
                $ratio = ($goalkeeperVote[0] + array_sum($threeBestDefendersVotes)) / 4;
            }

            return $this->_conversionTable->getDefenseBonus($ratio);
        }

        /**
         * Returns the entire formation with the vote and the magic points for each footballer.
         *
         * @inheritDoc
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
        public function getFormationDetails(array $footballers) {
            $formation = $this->_formationFactory->create($footballers);
            $allFootballers = array_merge($formation->getFirstStrings(), $formation->getReserves());

            $details = array();
            for ($i = 0; $i < count($allFootballers); $i++) {
                array_push($details, $this->_quotations[$allFootballers[$i]->getId()]->toArray());
            }

            return $details;
        }

        /**
         * Returns the number of goals associated to the given magic points.
         *
         * @see ConversionTable::$_goalsRange
         * @param float $magicPointsSum The sum of the magic points of the $formation
         * @return integer The number of goals.
         */
        public function getGoals($magicPointsSum) {
            return $this->_conversionTable->getGoals($magicPointsSum);
        }
    }
}