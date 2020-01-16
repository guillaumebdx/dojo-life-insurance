<?php


/**
 * Class LifeInsurance
 */
class LifeInsurance
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var DateTime
     */
    private $openDate;

    /**
     * @var float
     */
    private $initialPayment;

    /**
     * LifeInsurance constructor.
     * @param float $amount
     * @param DateTime $openDate
     * @param float $initialPayment
     */
    public function __construct(float $amount, DateTime $openDate, float $initialPayment)
    {
        $this->amount         = $amount;
        $this->openDate       = $openDate;
        $this->initialPayment = $initialPayment;
    }


    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return DateTime
     */
    public function getOpenDate() : DateTime
    {
        return $this->openDate;
    }

    /**
     * @param DateTime $openDate
     */
    public function setOpenDate(DateTime $openDate)
    {
        $this->openDate = $openDate;
    }

    /**
     * @return float
     */
    public function getInitialPayment() : float
    {
        return $this->initialPayment;
    }

    /**
     * @param float $initialPayment
     */
    public function setInitialPayment(float $initialPayment)
    {
        $this->initialPayment = $initialPayment;
    }
}
