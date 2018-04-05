<?php

namespace FFC\Calculator\Configuration\Rule;

use FFC\Calculator\ConversionTable\ConversionTableAbstract;
use FFC\Formation\Footballer\FootballerAbstract;
use FFQP\Model\Quotation;

abstract class RuleAbstract
{
    /**
     * @var ConversionTableAbstract
     */
    protected $conversionTable;

    public function __construct(ConversionTableAbstract $conversionTableAbstract = null)
    {
        $this->conversionTable = $conversionTableAbstract;
    }

    /**
     * @param FootballerAbstract[] $footballers
     * @param string $role
     * @return float[]
     */
    protected function getVotesByRole(array $footballers, string $role): array
    {
        $votes = array();
        foreach ($footballers as $footballer) {
            $footballerQuotation = $footballer->getQuotation();
            if ($footballerQuotation->getSecondaryRole() === $role) {
                $votes[] = $this->getVote($footballerQuotation);
            }
        }
        return $votes;
    }

    /**
     * @param Quotation $quotation
     * @return float
     */
    protected function getVote(Quotation $quotation): float
    {
        return $quotation->isWithoutVote() ? $quotation->getOriginalMagicPoints() : $quotation->getVote();
    }

    /**
     * @param float[] $votes
     * @return float
     */
    protected function getVotesAverage($votes): float
    {
        return array_sum($votes) / count($votes);
    }
}
