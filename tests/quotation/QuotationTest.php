<?php

use \FFC\Quotation as Quotation;

class QuotationTest extends PHPUnit_Framework_TestCase {

  public function badConfigProvider() {
    return array(
      array(array('')),
      array(array('id' => 1)),
      array(array('id' => 1, 'magicPoints' => 1)),
      array(array('id' => 1, 'vote' => 1)),
      array(array('magicPoints' => 1, 'vote' => 1)),
    );
  }

  public function goodConfigProvider() {
    return array(
      array(
        array('id' => '1', 'magicPoints' => '2', 'vote' => '3'),
        array('id' => 1, 'magicPoints' => 2.0, 'vote' => 3.0),
      ),
    );
  }

  /**
   * @expectedException Exception
   * @expectedExceptionMessage Missing parameter
   * @dataProvider badConfigProvider
   * @param Array $config
   */
  public function testBadConstructMethod($config) {
    $quotation = new Quotation($config);
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   */
  public function testGoodConstructMethod($config) {
    $quotation = new Quotation($config);
    $this->assertNotNull($quotation);
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   * @param Array $result
   */
  public function testGetIdMethod($config, $result) {
    $quotation = new Quotation($config);
    $this->assertSame($result['id'], $quotation->getId());
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   * @param Array $result
   */
  public function testGetMagicPointsMethod($config, $result) {
    $quotation = new Quotation($config);
    $this->assertSame($result['magicPoints'], $quotation->getMagicPoints());
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   * @param Array $result
   */
  public function testGetVoteMethod($config, $result) {
    $quotation = new Quotation($config);
    $this->assertSame($result['vote'], $quotation->getVote());
  }

  /**
   * @dataProvider goodConfigProvider
   * @param Array $config
   * @param Array $result
   */
  public function testToArrayMethod($config, $result) {
    $quotation = new Quotation($config);
    $this->assertSame($result, $quotation->toArray());
  }
}
