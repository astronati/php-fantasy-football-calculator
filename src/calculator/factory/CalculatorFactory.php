<?php

namespace FFC;

use \FFC\CalculatorFactoryInterface as CalculatorFactoryInterface;
use \FFC\Calculator as Calculator;
use \FFC\FormationFactory as FormationFactory;
use \FFC\QuotationFactory as QuotationFactory;
use \FFC\ConversionTable as ConversionTable;
use \FFC\ReportCard as ReportCard;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines a QuotationFactory
 */
class CalculatorFactory implements CalculatorFactoryInterface {

  /**
   * @inherit
   */
  public static function create(array $quotations, $options = array()) {
    return new Calculator(
      $quotations,
      $options,
      new FormationFactory(),
      new QuotationFactory(),
      ConversionTable::getInstance(),
      ReportCard::getInstance()
    );
  }
}
