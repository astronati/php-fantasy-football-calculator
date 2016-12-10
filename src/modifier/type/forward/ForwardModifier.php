<?php

/**
 * A forward modifier is used to determine bonus to add to the given formation.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * Allows to return a bonus to the given footballer.
     * @inheritDoc
     */
    class ForwardModifier extends ModifierAbstract {

        /**
         * Returns the bonus of the given forward.
         * @param array $config
         * @return float
         */
        public function getBonus(array $config)
        {
            // TODO: Implement getBonus() method.
        }
    }
}
