<?php

/**
 * A best defenders modifier is used to determine bonus to add to the given formation.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * Allows to return the bonus to add to the given formation based on the vote of the goalkeeper and the ones of the
     * best 3 (three) defenders.
     * @inheritDoc
     */
    class BestDefendersModifier extends ModifierAbstract
    {
        /**
         * Returns the bonus given from the best defenders modifier.
         * @inheritdoc
         * @param array $config It has to contain following keys:
         * - defenders such as an array of defender votes that played.
         * - goalkeeper such as the goalkeeper vote that played.
         * @return float
         */
        public function getBonus(array $config)
        {
            $defenderVotes = $config['defenders'];
            if (count($defenderVotes) >= 4) {
                // Orders from the highest value to the lowest one
                rsort($defenderVotes);
                // Takes three footballers with the highest vote and sum them
                $threeBestDefendersVotes = array_slice($defenderVotes, 0, 3);
                // Sums the goalkeeper and defenders votes and divide the result by 4 (the number of footballers)
                $average = ($config['goalkeeper'] + array_sum($threeBestDefendersVotes)) / 4;

                return $this->_conversionTable->getConvertedValue($average);
            }
            return 0;
        }
    }
}
