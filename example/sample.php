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
;
$calculator = new Calculator($quotations, $configuration);

// Prepare formation
$formation = new Formation();
$firstStrings = [102, 298, 416, 349, 377, 534, 580, 676, 732, 805, 900];
foreach ($firstStrings as $firstString) {
    $formation->addFirstString(new Footballer($firstString));
}
$reserves = [118, 354, 241, 632, 626, 922, 827];
foreach ($reserves as $reserve) {
    $formation->addReserve(new Footballer($reserve));
}

// Show single result...
$singleResult = $calculator->getSingleResult($formation);
echo $singleResult->getMagicPoints() . ' ' . $singleResult->getBonus() . PHP_EOL;
