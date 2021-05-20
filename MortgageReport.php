<?php

declare(strict_types=1);

class MortgageReport
{
    private $calculator;
    private $currency;

    public function __construct(MortgageCalculator $calculator, string $locale = 'de_DE')
    {
        $this->calculator = $calculator;
        $this->setCurrency($locale);
    }

    private function setCurrency(string $locale): void
    {
        $getLocales = \ResourceBundle::getLocales('');
        if (!in_array($locale, $getLocales))
            throw new InvalidArgumentException("Invalid locale supplied.");

        $this->currency = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
    }

    public function printMortgage(): void
    {
        $mortgage = $this->calculator->calculateMortgage();
        print("MORTGAGE\n");
        print("--------\n");
        print("Monthly Payments: " . $this->currency->format($mortgage) . "\n");
    }

    public function printPaymentSchedule(): void
    {
        print("\nPAYMENT SCHEUDLE\n");
        print("----------------\n");
        foreach ($this->calculator->getRemainingBalance() as $balance)
            print($this->currency->format($balance) . "\n");
    }
}
