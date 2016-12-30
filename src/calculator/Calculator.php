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
    use \FFC\FormationFactory as FormationFactory;
    use \FFC\QuotationFactory as QuotationFactory;
    use \FFC\ModifierFactory as ModifierFactory;
    use \FFC\ConversionTableFactory as ConversionTableFactory;
    use \FFC\ReportCard as ReportCard;

    /**
     * Used to calculate results of a fantasy football formation.
     */
    class Calculator implements CalculatorInterface
    {
        /**
         * An instance of the FormationFactory.
         * @var FormationFactory
         */
        private $_formationFactory;

        /**
         * An instance of the ModifierFactory.
         * @var ModifierFactory
         */
        private $_modifierFactory;

        /**
         * An instance of the ConversionTableFactory.
         * @var ConversionTableFactory
         */
        private $_conversionTableFactory;

        /**
         * An instance of the ReportCard.
         * @var ReportCard
         */
        private $_reportCard;

        /**
         * Returns a new instance of Calculator. To define a new instance, a list of quotations is needed.
         * Optionally it can be configured to calculate bonus.
         * @see Calculator::$_options
         * @see Quotation::_checkConfiguration
         * @param FormationFactory $formationFactory An instance of FormationFactory
         * @param ModifierFactory $modifierFactory An instance of ModifierFactory
         * @param ConversionTableFactory $conversionTableFactory An instance of ConversionTableFactory
         * @param ReportCard $reportCard An instance of ReportCard
         */
        public function __construct(
            FormationFactory $formationFactory,
            ModifierFactory $modifierFactory,
            ConversionTableFactory $conversionTableFactory,
            ReportCard $reportCard
        ) {
            $this->_formationFactory = $formationFactory;
            $this->_modifierFactory = $modifierFactory;
            $this->_conversionTableFactory = $conversionTableFactory;
            $this->_reportCard = $reportCard;
        }

        /**
         * Returns bonus of the formation and the malus of the opponent one.
         * @inheritDoc
         * @param array $footballers A $footballers element is a 'footballer' that to be instantiated needs to satisfy
         * Footballer::_checkConfiguration
         * @param array $opponentFootballers A $footballers element is a 'footballer' that to be instantiated needs to
         * satisfy Footballer::_checkConfiguration
         * @return array The container of all bonus
         */
        public function getBonus(array $footballers, array $opponentFootballers = null)
        {
            $formation = $this->_formationFactory->create($footballers);
            $bonus = [
                'bestDefenders' => $this->_modifierFactory
                    ->createBestDefendersModifier()
                    ->getBonus([
                        'goalkeeper' => $this->_indemnify($formation, 'Goalkeepers')[0],
                        'defenders' => $this->_indemnify($formation, 'Defenders')
                    ])
            ];

            if ($opponentFootballers) {
                $opponentFormation = $this->_formationFactory->create($opponentFootballers);
                return array_merge($bonus, [
                    'defense' => $this->_modifierFactory
                        ->createDefenseModifier()
                        ->getBonus([
                            'defenders' => $this->_indemnify($formation, 'Defenders')
                        ]),
                    'midfield' => $this->_modifierFactory
                        ->createMidfieldModifier()
                        ->getBonus([
                            'home' => $this->_indemnify($formation, 'Midfielders'),
                            'away' => $this->_indemnify($opponentFormation, 'Midfielders')
                        ]),
                    'forward' => $this->_modifierFactory
                        ->createForwardModifier()
                        ->getBonus([
                            'forwards' => $this->_indemnify($formation, 'Forwards')
                        ])
                ]);
            }
            return $bonus;
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
        public function getFormationDetails(array $footballers)
        {
            $formation = $this->_formationFactory->create($footballers);
            $footballers = $formation->getFootballers();
            return $this->_reportCard->getDetails($footballers);
        }

        /**
         * Returns the number of goals associated to the given magic points.
         *
         * @inheritDoc
         * @param float $magicPointsSum The sum of the magic points of the $formation
         * @return integer The number of goals.
         */
        public function getGoals($magicPointsSum)
        {
            return $this->_conversionTableFactory
                ->createGoalsConversionTable()
                ->getConvertedValue($magicPointsSum);
        }

        /**
         * Returns the sum of the magic points of the footballers of the formation.
         * It is calculated taking into account that there are a number of reserves by each role.
         *
         * @inheritDoc
         * @param array $footballers A list of array containing needed data to instantiate a Footballer
         * @return float The sum of points of the team keeping into account only 11 playing footballers.
         */
        public function getSum(array $footballers)
        {
            $formation = $this->_formationFactory->create($footballers);
            return array_sum($this->_indemnify($formation, 'Goalkeepers', 'MagicPoints')) +
                array_sum($this->_indemnify($formation, 'Defenders', 'MagicPoints')) +
                array_sum($this->_indemnify($formation, 'Midfielders', 'MagicPoints')) +
                array_sum($this->_indemnify($formation, 'Forwards', 'MagicPoints'));
        }

        /**
         * Returns the indemnified array of votes of footballers by role.
         *
         * @param Formation $formation
         * @param string $role
         * @param string $reportCard
         * @return array
         */
        private function _indemnify(Formation $formation, $role, $reportCard = 'Votes')
        {
            $roleFilter = 'filter' . $role;
            $reportCardFilter = 'get' . $reportCard;
            return $this->_reportCard->indemnify(
                $this->_reportCard->$reportCardFilter(
                    $formation->$roleFilter()->filterFirstStrings()->getFootballers()
                ),
                $this->_reportCard->$reportCardFilter(
                    $formation->$roleFilter()->filterReserves()->getFootballers()
                )
            );
        }
    }
}