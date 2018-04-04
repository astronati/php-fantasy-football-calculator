<?php

namespace FFC\Formation;

use FFC\Formation\Footballer\FootballerAbstract;
use FFQP\Model\Quotation;

interface FormationInterface
{
    /**
     * @param FootballerAbstract $footballer
     * @return FormationInterface
     */
    public function addFirstString(FootballerAbstract $footballer): FormationInterface;

    /**
     * @param FootballerAbstract $footballer
     * @return FormationInterface
     */
    public function addReserve(FootballerAbstract $footballer): FormationInterface;

    /**
     * @param Quotation[] $quotations
     */
    public function setQuotations(array $quotations);

    /**
     * @return FootballerAbstract[]
     */
    public function getWhoPlayed(): array;

    /**
     * @return FootballerAbstract[]
     */
    public function getAll(): array;
}
