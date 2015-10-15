<?php
/**
 * Description of Till
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Store;

class Till {
    
    private $products;

    public function __construct(\Cilex\Store\Products $products)
    {
        $this->products = $products;
    }
    
    public function getReceipt(\Cilex\Store\Receipt $receipt){
        
    }
    
    
}
