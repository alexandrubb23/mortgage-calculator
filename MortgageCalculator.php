<?php

declare(strict_types=1);

class MortgageCalculator
{
    private const MONTHS_IN_YEAR = 12;
    private const PERCENT = 100;

    private $principal;
    private $annualInterest;
    private $years;

    public function __construct(
        int $principal,
        float $annualInterest,
        int $years
    ) {
        $this->principal = $principal;
        $this->annualInterest = $annualInterest;
        $this->years = $years;
    }

    public function calculateMortgage(): float
    {
        $monthlyInterest = $this->getMonthlyInterest();
        $numberOfPayments = $this->getNumberOfPayments();

        return $this->principal
            * ($monthlyInterest * pow(1 + $monthlyInterest, $numberOfPayments))
            / (pow(1 + $monthlyInterest, $numberOfPayments) - 1);
    }

    public function calculateBalance(int $numberOfPaymentsMade): float
    {
        $monthlyInterest = $this->getMonthlyInterest();
        $numberOfPayments = $this->getNumberOfPayments();

        return $this->principal
            * (pow(1 + $monthlyInterest, $numberOfPayments) - pow(1 + $monthlyInterest, $numberOfPaymentsMade))
            / (pow(1 + $monthlyInterest, $numberOfPayments) - 1);
    }

    public function getRemainingBalance(): array
    {
        for ($month = 1; $month <= $this->getNumberOfPayments(); $month++)
            $balances[$month - 1] = $this->calculateBalance($month);

        return $balances;
    }

    private function getMonthlyInterest(): float
    {
        return $this->annualInterest / self::MONTHS_IN_YEAR / self::PERCENT;
    }

    private function getNumberOfPayments(): int
    {
        return $this->years * self::MONTHS_IN_YEAR;
    }
}
