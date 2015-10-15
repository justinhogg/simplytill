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

    public function getProperties()
    {
        return $this->properties;
    }

    public function addProperty($id, $value)
    {
        $this->properties[$id] = $value;
    }

    public function getProperty($id)
    {
        return $this->properties[$id];
    }
}
