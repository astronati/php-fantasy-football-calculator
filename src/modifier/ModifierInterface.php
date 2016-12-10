<?php

/**
 * Implements the Interface for a generic Modifier
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC
{
    /**
     * A modifier allows to return bonus/malus.
     * @codeCoverageIgnore
     */
    interface ModifierInterface
    {
        /**
         * Returns the bonus/malus to apply to the same team or to the other one according to the rules of the modifier
         * itself.
         * @param array $config
         * @return float The bonus/malus
         */
        public function getBonus(array $config);
    }
}
