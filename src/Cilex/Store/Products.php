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

    /**
     * getProperties - retuens all propertes for this object
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
     * @param sring $id
     * @param double $value
     */
    public function addProperty($id, $value)
    {
        $this->properties[$id] = $value;
    }

    /**
     * getProperty - gets an individual property
     *
     * @param string $id
     * @return double
     */
    public function getProperty($id)
    {
        return $this->properties[$id];
    }
}
