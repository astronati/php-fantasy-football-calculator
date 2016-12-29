<?php

/**
 * Returns a Calculator instance in order to get points and details of the given formation.
 *
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\CalculatorFactoryInterface as CalculatorFactoryInterface;
    use \FFC\Calculator as Calculator;
    use \FFC\FormationFactory as FormationFactory;
    use \FFC\ModifierFactory as ModifierFactory;
    use \FFC\ConversionTableFactory as ConversionTableFactory;
    use \FFC\ReportCard as ReportCard;

    /**
     * Defines a CalculatorFactory.
     * @codeCoverageIgnore
     */
    class CalculatorFactory implements CalculatorFactoryInterface
    {
        /**
         * Returns a new instance of the Calculator class.
         * @inheritDoc
         * @param Quotation[] $quotations An array of Quotation instances
         * @return Calculator
         */
        public function create(array $quotations) {
            $reportCardFactory = new ReportCardFactory();
            return new Calculator(
                new FormationFactory(),
                new ModifierFactory(),
                new ConversionTableFactory(),
                $reportCardFactory->create($quotations)
            );
        }
    }
}
