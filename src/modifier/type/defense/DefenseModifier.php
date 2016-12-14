<?php

/**
 * A defense modifier is used to determine malus to give to the other formation.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * Defense modifier is calculated through votes of first strings defenders.
     * @inheritDoc
     */
    class DefenseModifier extends ModifierAbstract {

        /**
         * Returns the malus to add to the sum of magic points of the opponent formation.
         * @param array $config
         * @return float
         */
        public function getBonus(array $config)
        {
            $defenders = $config['defenders'];
            // Conversion table is applied with a defense of 4 footballers by default.
            $malus = $this->_conversionTable->getConvertedValue($this->_getAverage($defenders));
            // If the defense is composed with a number of footballers different from 4, then the malus can be changed.
            // Malus is increased if the defense has more than 4 footballers.
            // Malus is decreased if the defense has 3 footballers.
            // The points to add/remove to the malus is given by the difference between the number of defenders and 4.
            return $malus - (count($defenders) - 4);
        }
    }
}
