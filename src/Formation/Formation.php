<?php

namespace FFC\Formation;

use FFC\Formation\Footballer\FootballerAbstract;

class Formation implements FormationInterface
{
    /**
     * @var FootballerAbstract[]
     */
    private $firstStrings = array();

    /**
     * @var FootballerAbstract[]
     */
    private $reserves = array();

    /**
     * @inheritdoc
     */
    public function addFirstString(FootballerAbstract $footballer): FormationInterface
    {
        $this->firstStrings[] = $footballer;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addReserve(FootballerAbstract $footballer): FormationInterface
    {
        $this->reserves[] = $footballer;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setQuotations(array $quotations)
    {
        foreach ($this->firstStrings as $footballer) {
            $footballer->setQuotation($quotations[$footballer->getCode()]);
        }

        foreach ($this->reserves as $footballer) {
            $footballer->setQuotation($quotations[$footballer->getCode()]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getWhoPlayed(): array
    {
        $footballers = array();
        foreach ($this->firstStrings as $firstString) {
            if ($firstString->getQuotation()->hasPlayed()) {
                $firstString->enterTheGame();
                $footballers[] = $firstString;
            }
            else {
                foreach ($this->reserves as $reserve) {
                    if ($reserve->getQuotation()->getSecondaryRole() == $firstString->getQuotation()->getSecondaryRole()
                            && $reserve->getQuotation()->hasPlayed()
                            && !$reserve->hasEnteredTheGame()) {
                        $reserve->enterTheGame();
                        $footballers[] = $reserve;
                    }
                }
            }
        }
        return $footballers;
    }
}
