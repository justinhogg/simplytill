<?php
/**
 * Description of Transaction
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Store;

class Transaction
{
    private $products;
    private $totalValue = 0.00;
    private $totalDiscount = 0.00;
    
    public function __construct(\Cilex\Store\Products $products)
    {
        $this->products = $products;
    }
    
    public function addProduct($key, $value)
    {
        $this->add((double) $value);
        
        $this->products->addProperty($key, $value);
    }
    
    public function addDiscount($amount)
    {
        if (is_double($amount)) {
            $this->totalDiscount = $this->totalDiscount + $amount;
            return true;
        }
        
        return false;
    }
    
    public function add($amount)
    {
        if (is_double($amount)) {
            $this->totalValue = $this->totalValue + $amount;
            return true;
        }
        
        return false;
    }
    
    public function subtract($amount)
    {
        if (is_double($amount)) {
            $this->totalValue = $this->totalValue - $amount;
            return true;
        }
        
        return false;
    }

    public function getTotalValue()
    {
        return ($this->totalValue-$this->totalDiscount);
    }
    
    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }
    
    public function getSubTotal()
    {
        return $this->totalValue;
    }
    
    public function getReceipt()
    {
        return \Cilex\Store\Receipt::display(
            $this->products,
            $this->getSubTotal(),
            $this->gettotalValue(),
            $this->getTotalDiscount()
        );
    }
}
