<?php

namespace FFC;

/**
 * @author Andrea Stronati <astronati@vendini.com>
 * @license MIT http://opensource.org/licenses/MIT
 * @copyright 2016 Andrea Stronati
 * @version 0.1.0
 */

/**
 * Defines the interface of a ReportCard
 */
interface ReportCardInterface {

  /**
   * Returns the instance of the ReportCard.
   * It implements the Singleton pattern.
   *
   * @return ReportCard
   */
  public static function getInstance();

  /**
   * Returns the votes of the footballers that have played. Filtering is performed by role.
   *
   * @param Formation $formation
   * @param string $role
   * @param Array $quotations An array of Quotation instances
   * @param boolean $useMagicPoints If true, it returns the magic points of the footballers otherwise their votes.
   * @return Array
   */
  public function getVotes($formation, $quotations, $role, $useMagicPoints = true);
}
