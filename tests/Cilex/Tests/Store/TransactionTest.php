<?php
/**
 * Description of TransactionTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Store;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Store\Transaction
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
        $mockObject = $this->getMock('\Cilex\Store\Products', array('getProperties', 'addProperty', 'getProperty'),array());
        
        switch($this->getName()) {
            default:
                break;
        }
        //set up test object
        $this->object = new \Cilex\Store\Transaction($mockObject);
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
     * @covers Cilex\Store\Transaction::__construct
     */
    public function testConstruct()
    {
        //test that this instantiated object is an instance of the test object
        $this->assertInstanceOf('\Cilex\Store\Transaction', $this->object);
    }
    
    /**
     * @covers Cilex\Store\Transaction::addProduct
     * @covers Cilex\Store\Transaction::getTotalValue
     */
    public function testAddProduct()
    {
        $this->object->addProduct('test', 1.00);
        
        $this->assertEquals(1.00, $this->object->getTotalValue());
        
    }
    
    /**
     * @covers Cilex\Store\Transaction::addProduct
     * @covers Cilex\Store\Transaction::getTotalValue
     */
    public function testAddAdditionalProduct()
    {
        $this->object->addProduct('test', 1.00);
        
        $this->assertEquals(1.00, $this->object->getTotalValue());
        
        $this->object->addProduct('test1', 2.00);
        
        $this->assertEquals(3.00, $this->object->getTotalValue());
    }
    
    /**
     * @covers Cilex\Store\Transaction::addDiscount
     * @covers Cilex\Store\Transaction::getTotalValue
     * @covers Cilex\Store\Transaction::getSubTotal
     */
    public function testAddDiscount()
    {
        $this->object->addProduct('test', 1.00);
        
        $result = $this->object->addDiscount(10, $this->object->getSubTotal());
        
        $this->assertTrue($result);
        
        $this->assertEquals(0.90, $this->object->getTotalValue());
    }
    
    /**
     * @covers Cilex\Store\Transaction::addDiscount
     */
    public function testAddInvalidDiscount()
    {   
        $result = $this->object->addDiscount('test', $this->object->getSubTotal());
        
        $this->assertFalse($result);
        
    }
    
    /**
     * @covers Cilex\Store\Transaction::addDiscount
     */
    public function testAddNegativeDiscount()
    {
        $result = $this->object->addDiscount(-10, $this->object->getSubTotal());
        
        $this->assertFalse($result);
    }
    
    /**
     * @covers Cilex\Store\Transaction::add
     * @covers Cilex\Store\Transaction::getTotalValue
     */
    public function testAdd()
    {
        $result = $this->object->add(1.00);
        
        $this->assertTrue($result);
        
        $this->assertEquals(1.00, $this->object->getTotalValue());
    }
    
    /**
     * @covers Cilex\Store\Transaction::add
     */
    public function testBadAdd()
    {
        $result = $this->object->add('test');
        
        $this->assertFalse($result);
    }
    
    /**
     * @covers Cilex\Store\Transaction::getTotalDiscount
     */
    public function testGetDefaultTotalDiscount()
    {
        $this->assertEquals(0.00, $this->object->getTotalDiscount());
    }
    
    /**
     * @covers Cilex\Store\Transaction::getTotalDiscount
     * @covers Cilex\Store\Transaction::addDiscount
     * @covers Cilex\Store\Transaction::add
     */
    public function testGetTotalDiscount()
    {
        $this->object->add(1.00);
        $this->object->addDiscount(10, $this->object->getSubTotal());
        
        $this->assertEquals(0.10, $this->object->getTotalDiscount());
    }
    
    /**
     * @covers Cilex\Store\Transaction::getTotalValue
     */
    public function testGetDefaultTotalValue()
    {
        $this->assertEquals(0.00, $this->object->getTotalValue());
    }
    
    /**
     * @covers Cilex\Store\Transaction::getTotalValue
     * @covers Cilex\Store\Transaction::add
     */
    public function testGetTotalValue()
    {
        $this->object->add(1.23);
        $this->object->add(1.23);
        
        $this->assertEquals(2.46, $this->object->getTotalValue());
    }
    
    /**
     * @covers Cilex\Store\Transaction::getTotalValue
     * @covers Cilex\Store\Transaction::add
     * @covers Cilex\Store\Transaction::addDiscount
     * @covers Cilex\Store\Transaction::getSubTotal
     */
    public function testGetTotalValueWithDiscount()
    {
        $this->object->add(1.25);
        $this->object->add(1.25);
        $this->object->addDiscount(20, $this->object->getSubTotal());
        
        $this->assertEquals(2.00, $this->object->getTotalValue());
    }
    
    /**
     * @covers Cilex\Store\Transaction::getSubTotal
     */
    public function testGetDefaultSubTotal()
    {
        $this->assertEquals(0.00, $this->object->getSubTotal());
    }
    
    /**
     * @covers Cilex\Store\Transaction::getSubTotal
     * @covers Cilex\Store\Transaction::add
     */
    public function testGetSubTotal()
    {
        $this->object->add(1.50);
        $this->object->add(1.25);
        
        $this->assertEquals(2.75, $this->object->getSubTotal());
    }
    
    /**
     *  @covers Cilex\Store\Transaction::getReceipt
     *  @covers Cilex\Store\Transaction::addProduct
     */
    public function testGetValidReceipt()
    {
        $this->object->addProduct('test', 1.00);
        
        $result = $this->object->getReceipt();
        
        $this->assertEquals(9, count($result));
    }
}
   
