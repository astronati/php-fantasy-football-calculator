<?php

/**
 * Report Card allows to compare votes and quotations of footballers in order to return the right votes per each role.
 *
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.2.1
 */

namespace FFC {

    use \FFC\ReportCardInterface as ReportCardInterface;
    use \FFC\QuotationFactory as QuotationFactory;

    /**
     * Defines a ReportCard.
     * Report Card is used to return the votes, magic points and details of the given footballers.
     */
    class ReportCard implements ReportCardInterface {

        /**
         * A container of Quotation(s)
         * @var Quotation[] It has following structure
         * [
         *   'footballerID' => [
         *     'vote' => ...
         *     'magicPoints' => ...
         *     ...
         *   ],
         *   ...
         * ]
         */
        private $_quotations = [];

        /**
         * Associates quotations to the ReportCard instance
         * @param array[] $config
         * @param QuotationFactory $quotationFactory
         */
        public function __construct(array $config, QuotationFactory $quotationFactory)
        {
            for ($i = 0; $i < count($config); $i++) {
                $quotation = $quotationFactory->create($config[$i]);
                // Fills $this->_quotations with Quotation instances
                $this->_quotations[$quotation->getFootballerId()] = $quotation;
            }
        }

        /**
         * Returns all details (from quotations) per each footballers of the given match.
         * @param Footballer[] $footballers
         * @return array
         */
        public function getDetails(array $footballers)
        {
            $details = [];
            for ($i = 0; $i < count($footballers); $i++) {
                $details[$footballers[$i]->getId()] = $this->_quotations[$footballers[$i]->getId()]->toArray();
            }
            return $details;
        }

        /**
         * Returns an array containing only magic points per each given footballers. A footballer can have:
         * - specified magic points
         * - 0 (that is a valid value)
         * - null
         * @param Footballer[] $footballers
         * @return float[]
         */
        public function getMagicPoints(array $footballers)
        {
            $magicPoints = [];
            for ($i = 0; $i < count($footballers); $i++) {
                array_push($magicPoints, $this->_quotations[$footballers[$i]->getId()]->getMagicPoints());
            }
            return $magicPoints;
        }

        /**
         * Returns an array containing the votes of given players. A footballer can have:
         * - specified vote
         * - 0 (that is a valid value)
         * - null
         * @inheritDoc
         * @param Footballer[] $footballers
         * @return float[]
         */
        public function getVotes(array $footballers)
        {
            $votes = [];
            for ($i = 0; $i < count($footballers); $i++) {
                $vote = $this->_quotations[$footballers[$i]->getId()]->getVote();
                // It could happen that a footballer has magic points only. This happens when a match is not played and
                // the newspaper assigns a 6 by default.
                if (is_null($vote)) {
                    $vote = $this->_quotations[$footballers[$i]->getId()]->getMagicPoints();
                }
                array_push($votes, $vote);
            }
            return $votes;
        }

        /**
         * Replace NULL values in $votes with the ones provided by $reserves. The order of $reserves value is the same
         * used to take the first value to use in $votes.
         *
         * @param array $votes
         * @param array $reserves
         * @return array
         */
        public function indemnify(array $votes, array $reserves)
        {
            $index = 0;
            foreach ($votes as &$vote) {
                if (is_null($vote) && $index < count($reserves)) {
                    $vote = $reserves[$index++];
                }
            }
            return $votes;
        }
    }
}
