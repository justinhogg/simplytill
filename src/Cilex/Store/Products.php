<?php
/**
 * Description of Products
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Store;

class Products 
{
    private $properties = array();
    
    public function __construct() {}

    /**
     * getProperties - returns all propertes for this object
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * addProperty - adds a property to this object
     *
     * @param mixed $id
     * @param mixed $value
     */
    public function addProperty($id, $value)
    {
        $this->properties[$id] = $value;
        
    }

    /**
     * getProperty - gets an individual property
     *
     * @param mixed $id
     * @return mixed|null
     */
    public function getProperty($id)
    {
        return (isset($this->properties[$id])) ? $this->properties[$id] : null;
    }
}
