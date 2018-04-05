<?php

namespace FFC\Calculator;

use FFC\Calculator\Configuration\Configuration;
use FFC\Calculator\Result\MatchResult;
use FFC\Calculator\Result\Result;
use FFC\Calculator\Result\ResultFactory;
use FFC\Formation\Formation;
use FFQP\Model\Quotation;

/**
 * The calculator is used to retrieve information of a match result like:
 * - the total of magic points
 * - the defense bonus
 * - other bonus...
 */
class Calculator implements CalculatorInterface
{
    /**
     * @var Quotation[] $quotations
     */
    private $quotations = [];

    /**
     * @var Configuration $configuration
     */
    private $configuration;

    /**
     * @param Quotation[] $quotations
     * @param Configuration $configuration
     */
    public function __construct(array $quotations, Configuration $configuration)
    {
        foreach ($quotations as $quotation) {
            $this->quotations[$quotation->getCode()] = $quotation;
        }
        $this->configuration = $configuration;
    }

    /**
     * @inheritdoc
     */
    public function getSingleResult(Formation $formation): Result
    {
        $formation->setQuotations($this->quotations);
        $footballers = $formation->getWhoPlayed();

        $resultFactory = new ResultFactory();
        return $resultFactory->createResult($footballers, $this->configuration);
    }

    /**
     * @inheritdoc
     */
    public function getMatchResult(Formation $homeFormation, Formation $awayFormation): MatchResult
    {
        $homeFormation->setQuotations($this->quotations);
        $homeFootballers = $homeFormation->getWhoPlayed();

        $awayFormation->setQuotations($this->quotations);
        $awayFootballers = $awayFormation->getWhoPlayed();

        $resultFactory = new ResultFactory();
        return $resultFactory->createMatchResult($homeFootballers, $awayFootballers, $this->configuration);
    }
}
