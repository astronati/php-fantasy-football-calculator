<?php

/**
 * Allows to determine the bonus/malus of the midfield.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * The MidfieldModifier is given comparing the midfields total between 2 formations.
     * @inheritDoc
     */
    class MidfieldModifier extends ModifierAbstract {

        /**
         * Adds reserve votes in order to obtain two groups of votes with the same number of votes.
         * @param float[] $midfielders
         * @param integer $increment
         */
        private function _fillMidfielders(array &$midfielders, $increment = 0)
        {
            for ($i = 0; $i < $increment; $i++) {
                array_push($midfielders, 5);
            }
        }

        /**
         * Returns the bonus/malus to give to both formations
         * @param array $config
         * @return float
         */
        public function getBonus(array $config)
        {
            $homeMidfielders = $config['home'];
            $awayMidfielders = $config['away'];
            // Determines the difference of the numbers of footballers.
            $difference = abs(count($homeMidfielders) - count($awayMidfielders));

            if (count($homeMidfielders) > count($awayMidfielders)) {
                $this->_fillMidfielders($awayMidfielders, $difference);
            }
            if (count($homeMidfielders) < count($awayMidfielders)) {
                $this->_fillMidfielders($homeMidfielders, $difference);
            }

            $bonus = $this->_conversionTable->getConvertedValue(abs(
                $this->_getAverage($homeMidfielders) - $this->_getAverage($awayMidfielders)
            ));

            return ($this->_getAverage($homeMidfielders) > $this->_getAverage($awayMidfielders) ? 1 : -1) * $bonus;
        }
    }
}
