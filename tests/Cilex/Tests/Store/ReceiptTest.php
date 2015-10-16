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
     * @var class
     */
    protected $mockObject;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->mockObject = $this->getMock('\Cilex\Store\Products', array('getProperties', 'addProperty', 'getProperty'),array());
        //set up test object
        $this->object = null;
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
     * @covers Cilex\Store\Receipt::__construct
     */
    public function testConstruct()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
   
    /**
     * @covers Cilex\Store\Receipt::display
     */
    public function testDisplayWithProductValueDouble()
    {
        $this->mockObject->expects($this->exactly(2))->method('getProperties')->will($this->returnValue(array('test' => 1.00)));
        
        $result = \Cilex\Store\Receipt::display($this->mockObject, 1.00, 1.00, 0.00);

        $this->assertEquals(9, count($result));
    }
    
    /**
     * @covers Cilex\Store\Receipt::display
     */
    public function testDisplayWithProductValueText()
    {
        $this->mockObject->expects($this->exactly(2))->method('getProperties')->will($this->returnValue(array('test' => 'testValue')));
        
        $result = \Cilex\Store\Receipt::display($this->mockObject, 1.00, 1.00, 0.00);
        
        $this->assertEquals(9, count($result));
    }
    
    /**
     * @covers Cilex\Store\Receipt::display
     */
    public function testDisplayWithNoProducts()
    {
        $this->mockObject->expects($this->exactly(1))->method('getProperties')->will($this->returnValue(array()));
        
        $result = \Cilex\Store\Receipt::display($this->mockObject, 1.00, 1.00, 0.00);
        
        $this->assertEquals(9, count($result));
        
        $this->assertEquals($result[2], 'There are no products to display!');
    }
    
    /**
     * @covers Cilex\Store\Receipt::display
     */
    public function testDisplayWithDiscount()
    {
        $this->mockObject->expects($this->exactly(2))->method('getProperties')->will($this->returnValue(array('test' => 1.00)));
        
        $result = \Cilex\Store\Receipt::display($this->mockObject, 1.00, 1.00, 1.00);
        
        $this->assertEquals(9, count($result));
    }
}
   
