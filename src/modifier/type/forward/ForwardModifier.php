<?php

/**
 * A forward modifier is used to determine bonus to add to each single forward.
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.3.0
 */

namespace FFC {

    use \FFC\ModifierAbstract as ModifierAbstract;

    /**
     * The Forward bonus can be added to all those forwards that did not score but own vote is higher than 6.
     * So this bonus is a sum of each single bonus that has been given to each forward.
     * @inheritDoc
     */
    class ForwardModifier extends ModifierAbstract {

        /**
         * Returns the bonus of the given forward.
         * @param array $config It has to contain following keys:
         * - forwards such as an array of forwards votes that played and didn't score or missed a penalty.
         * @return float
         */
        public function getBonus(array $config)
        {
            $bonus = 0;
            $forwards = $config['forwards'];
            foreach ($forwards as $forward) {
                $bonus += $this->_conversionTable->getConvertedValue($forward);
            }
            return $bonus;
        }
    }
}
