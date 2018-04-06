<?php

require_once __DIR__ . '/../vendor/autoload.php';

use FFC\Calculator\Calculator;
use FFC\Calculator\Configuration\Configuration;
use FFC\Calculator\Configuration\Rule\RuleFactory;
use FFC\Formation\Formation;
use FFQP\Parser\QuotationsParserFactory;

require_once __DIR__ . '/Footballer.php';

// Parse quotations
$quotationParser = QuotationsParserFactory::create(QuotationsParserFactory::FORMAT_GAZZETTA_SINCE_2017);
$quotations = $quotationParser->getQuotations(__DIR__ . '/files/quotazioni_gazzetta_30.xls');

// Configure calculator
$configuration = new Configuration();
$configuration
  ->addRule(RuleFactory::create(RuleFactory::BEST_DEFENDERS_RULE))
  ->addRule(RuleFactory::create(RuleFactory::HOME_RULE))
;
$calculator = new Calculator($quotations, $configuration);

// Prepare formation A
$formationA = new Formation();
$firstStringsA = [102, 298, 416, 349, 377, 534, 580, 676, 732, 805, 900];
foreach ($firstStringsA as $firstString) {
    $formationA->addFirstString(new Footballer($firstString));
}
$reservesA = [118, 354, 241, 632, 626, 922, 827];
foreach ($reservesA as $reserve) {
    $formationA->addReserve(new Footballer($reserve));
}

// Prepare formation B
$formationB = new Formation();
$firstStringsB = [114, 398, 321, 390, 396, 555, 709, 687, 865, 879, 828];
foreach ($firstStringsB as $firstString) {
    $formationB->addFirstString(new Footballer($firstString));
}
$reservesB = [115, 231, 375, 515, 613, 908, 927];
foreach ($reservesB as $reserve) {
    $formationB->addReserve(new Footballer($reserve));
}

// Show match results...
$matchResult = $calculator->getMatchResult($formationA, $formationB);
$homeResult = $matchResult->getHomeResult();
$awayResult = $matchResult->getAwayResult();
echo '(' . $homeResult->getMagicPoints() . ' ' . $homeResult->getBonus() . ') '. $matchResult->getHomeGoals() . PHP_EOL;
echo '(' . $awayResult->getMagicPoints() . ' ' . $awayResult->getBonus() . ') '. $matchResult->getAwayGoals() . PHP_EOL;
