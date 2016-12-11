<?php

/**
 * Allows to determine the bonus/malus of the midfield.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * The MidfieldModifier is given comparing the midfields total between 2 formations.
     * @inheritDoc
     */
    class MidfieldModifier extends ModifierAbstract {

        /**
         * Returns the bonus/malus to give to both formations
         * @param array $config
         * @return float
         */
        public function getBonus(array $config)
        {
            $homeMidfielders = $config['home'];
            $awayMidfielders = $config['away'];
            $difference = abs(count($homeMidfielders) - count($awayMidfielders));
            if (count($homeMidfielders) > count($awayMidfielders)) {
                for ($i = 0; $i < $difference; $i++) {
                    array_push($awayMidfielders, 5);
                }
            }
            if (count($homeMidfielders) < count($awayMidfielders)) {
                for ($i = 0; $i < $difference; $i++) {
                    array_push($homeMidfielders, 5);
                }
            }

            $homeAverage = array_sum($homeMidfielders) / count($homeMidfielders);
            $awayAverage = array_sum($awayMidfielders) / count($awayMidfielders);

            $bonus = $this->_conversionTable->getConvertedValue(abs($homeAverage - $awayAverage));

            return $homeAverage < $awayAverage ? $bonus * (-1) : $bonus;
        }
    }
}
