<?php
/**
 * Description of Receipt
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Store;

class Receipt
{   
    private $products;
    
    public function __construct(\Cilex\Store\Products $products)
    {
        $this->products = $products;
    }
}
