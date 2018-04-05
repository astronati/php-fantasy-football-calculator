<?php

namespace FFC\Formation;

use FFC\Formation\Footballer\FootballerAbstract;
use FFQP\Model\Quotation;

interface FormationInterface
{
    /**
     * Add footballer as first string.
     * @param FootballerAbstract $footballer
     * @return FormationInterface
     */
    public function addFirstString(FootballerAbstract $footballer): FormationInterface;

    /**
     * Add footballer as reserve.
     * NOTE: The order used to add footballers is used to prioritize their entry into play.
     * @param FootballerAbstract $footballer
     * @return FormationInterface
     */
    public function addReserve(FootballerAbstract $footballer): FormationInterface;

    /**
     * Associate quotations only to the footballers of the formation
     * @param Quotation[] $quotations
     */
    public function setQuotations(array $quotations);

    /**
     * Returns only the footballers that are taken into account to calculate the magic points the formation reached.
     * @return FootballerAbstract[]
     */
    public function getWhoPlayed(): array;
}
