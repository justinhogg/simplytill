<?php
/**
 * Description of ReceiptTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Store;

class ReceiptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Store\Receipt
     */
    protected $object;

     /**
     * @var class
     */
    protected $class;

    /**
     *
     * @var array
     */
    protected $attributes;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        //set up test object
        //set up test object
        $this->object = $this->getMockForAbstractClass('Cilex\Store\Receipt', array());
    }
    
    /**
     * Tears down the fixture.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    /**
     * Tests whether the constructor instantiates the correct dependencies.
     */
    public function testConstruct()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
   
