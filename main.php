<?php

require 'classes/Console.php';
require 'classes/MortgageCalculator.php';
require 'classes/MortgageReport.php';

$principal = Console::readNumber("Principal:", 1000, 1000_000);
$annualInterest = Console::readNumber("Annual Interest Rate:", 1, 30);
$years = Console::readNumber("Years:", 1, 30);

$calculator = new MortgageCalculator((int) $principal, (float) $annualInterest, (int) $years);

$report = new MortgageReport($calculator);
$report->printMortgage();
$report->printPaymentSchedule();
