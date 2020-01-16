<?php

require_once 'LifeInsurance.php';

/**
 * Class Withdrawal
 */
class Withdrawal
{
    const FLAT_TAXES = [
        0 => 35,
        1 => 35,
        2 => 35,
        3 => 35,
        4 => 15,
        5 => 15,
        6 => 15,
        7 => 15,
        8 => 7.5
    ];

    const MAX_YEAR = 8;

    const ABATMENT = 4600;

    const SOCIAL_TAX = 17.2;

    /**
     * @var float
     */
    private $gain;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var bool
     */
    private $isFlatTax;

    /**
     * @var float
     */
    private $taxAmount;


    /**
     * @var int
     */
    private $taxRate;

    /**
     * @var LifeInsurance
     */
    private $lifeInsurance;

    /**
     * Withdrawal constructor.
     * @param int $taxRate
     * @param LifeInsurance $lifeInsurance
     */
    public function __construct(int $taxRate, LifeInsurance $lifeInsurance)
    {
        $this->taxRate = $taxRate;
        $this->lifeInsurance = $lifeInsurance;
    }

    /**
     *
     */
    private function calculateGain() : void
    {
        $this->setGain($this->lifeInsurance->getAmount() - $this->lifeInsurance->getInitialPayment());
    }

    /**
     *
     */
    private function calculateDuration() : void
    {
        $dateDiff = $this->lifeInsurance
            ->getOpenDate()
            ->diff(new DateTime('now'))
            ->y;
        $this->setDuration($dateDiff);
    }


    private function calculateFlatTax(): float
    {
        if ($this->getDuration() >= self::MAX_YEAR) {
            $result = ($this->getGain() - self::ABATMENT) * self::FLAT_TAXES[self::MAX_YEAR];
        } else {
            $result =  $this->getGain() * self::FLAT_TAXES[$this->getDuration()];
        }

        return $result / 100;

    }


    private function calculateIncomeTax(): float
    {
        $gain = $this->duration >= self::MAX_YEAR ? $this->getGain() - self::ABATMENT : $this->getGain();
        return $gain * $this->getTaxRate() / 100;
    }

    /**
     *
     */
    private function makeChoice() : void
    {
        $isFlatTax = true;
        if ($this->calculateFlatTax() >= $this->calculateIncomeTax()){
            $isFlatTax = false;
        }
        $this->setIsFlatTax($isFlatTax);

    }

    /**
     * @return float
     */
    public function totalAmount() : float
    {
        $this->calculateDuration();
        $this->calculateGain();
        $this->makeChoice();
        if ($this->isFlatTax) {
            $result = $this->calculateFlatTax();
        } else {
            $result = $this->calculateIncomeTax();
        }
        return $result + ($this->getGain() *  self::SOCIAL_TAX / 100);
    }

    /**
     * @return mixed
     */
    public function getGain()
    {
        return $this->gain;
    }

    /**
     * @param mixed $gain
     */
    public function setGain($gain)
    {
        $this->gain = $gain;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getIsFlatTax()
    {
        return $this->isFlatTax;
    }

    /**
     * @param mixed $isFlatTax
     */
    public function setIsFlatTax($isFlatTax)
    {
        $this->isFlatTax = $isFlatTax;
    }

    /**
     * @return mixed
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param mixed $taxAmount
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }


    /**
     * @return mixed
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param mixed $taxRate
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @return mixed
     */
    public function getLifeInsurance()
    {
        return $this->lifeInsurance;
    }

    /**
     * @param mixed $lifeInsurance
     */
    public function setLifeInsurance($lifeInsurance)
    {
        $this->lifeInsurance = $lifeInsurance;
    }




}
