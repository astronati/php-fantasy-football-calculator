<?php

/**
 * A defense modifier is used to determine bonus/malus to give to the other formation.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * Allows to return a bonus using only votes of defenders that played for the given formation.
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
            // TODO: Implement getBonus() method.
        }
    }
}
