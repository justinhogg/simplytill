<?php
/**
 * Description of ProductsTest
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Tests\Store;

class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cilex\Store\Products
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
        $this->object = new \Cilex\Store\Products();
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
     * @covers Cilex\Store\Products::__construct
     */
    public function testConstruct()
    {
        //test that this instantiated object is an instance of the test object
        $this->assertInstanceOf('\Cilex\Store\Products', $this->object);
    }
    
    /**
     * @covers Cilex\Store\Products::getProperties
     * @covers Cilex\Store\Products::addProperty
     */
    public function testGetProperties()
    {
        $this->object->addProperty('test', 'testValue');
        
        $result = $this->object->getProperties();
        
        $this->assertEquals(1, count($result));
        $this->assertArrayHasKey('test', $result);
        
    }
    
    /**
     * @covers Cilex\Store\Products::getProperties
     */
    public function testGetPropertiesWithNoneAdded()
    {
        $this->assertEquals(0, count($this->object->getProperties()));
    }
    
    /**
     * @covers Cilex\Store\Products::getProperty
     * @covers Cilex\Store\Products::addProperty
     */
    public function testGetValidProperty()
    {
        $this->object->addProperty('test', 'testValue');
        
        $result = $this->object->getProperty('test');
        
        $this->assertEquals('testValue', $result);
        
    }
    
    /**
     * @covers Cilex\Store\Products::getProperty
     */
    public function testGetBadProperty()
    {
        $result = $this->object->getProperty('test');
        
        $this->assertNull($result);
    }
    
    /**
     * @covers Cilex\Store\Products::addProperty
     */
    public function testAddProperty()
    {
        $this->object->addProperty('test', 'testValue');
        
        $result = $this->object->getProperty('test');
        
        $this->assertEquals('testValue', $result);
    }
    
    /**
     * @covers Cilex\Store\Products::addProperty
     * @covers Cilex\Store\Products::getProperties
     */
    public function testAddMultipleProperties()
    {
        $this->object->addProperty('test', 'testValue');
        $this->object->addProperty('test1', 'testValue');
        
        $result = $this->object->getProperties();
        
        $this->assertEquals(2, count($result));
    }
    
    /**
     * @covers Cilex\Store\Products::addProperty
     * @covers Cilex\Store\Products::getProperties
     */
    public function testAddMultiplePropertiesSameKeys()
    {
        $this->object->addProperty('test', 'testValue');
        $this->object->addProperty('test', 'testValue2');
        
        $result = $this->object->getProperties();
        
        $this->assertEquals(1, count($result));
        
        $this->assertArrayHasKey('test', $result);
        
        $this->assertEquals('testValue2', $result['test']);
    }
    
    public function testAddBadProperty()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
   
