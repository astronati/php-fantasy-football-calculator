<?php

/**
 * @inheritDoc
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\FormationFactoryInterface as FormationFactoryInterface;
    use \FFC\Footballer as Footballer;
    use \FFC\Formation as Formation;

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    class FormationFactory implements FormationFactoryInterface {

        /**
         * @inheritDoc
         */
        public function create($container = array()) {
            $footballers = array();

            foreach ($container as $config) {
                array_push($footballers, new Footballer($config));
            }

            return new Formation($footballers);
        }
    }
}
