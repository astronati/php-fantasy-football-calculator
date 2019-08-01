<?php

namespace FFC\Formation;

use FFC\Formation\Footballer\FootballerInterface;

class Formation implements FormationInterface
{
    /**
     * @var FootballerInterface[]
     */
    protected $firstStrings = [];

    /**
     * @var FootballerInterface[]
     */
    protected $reserves = [];

    /**
     * @inheritdoc
     */
    public function addFirstString(FootballerInterface $footballer): FormationInterface
    {
        $this->firstStrings[] = $footballer;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addReserve(FootballerInterface $footballer): FormationInterface
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
        $footballers = [];
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
