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
    
    /**
     * constructor
     * @param \Cilex\Store\Products $products
     */
    public function __construct(\Cilex\Store\Products $products)
    {
        $this->products = $products;
    }
    
    /**
     * addProduct - adds a product to the transaction
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function addProduct($key, $value)
    {
        //add to total
        $this->add((double) $value);
        //add to product object
        $this->products->addProperty($key, $value);
    }
    
    /**
     * addDiscount - applies a discount to the transaction
     * 
     * @param int $discount
     * @param double $totalValue
     * @return boolean
     */
    public function addDiscount($discount, $totalValue)
    {
        if (is_int($discount) && is_double($totalValue) && $discount > 0) {
            $percentageAmount = number_format(
                (($discount/100) * $totalValue),
                2
            );
            $this->totalDiscount = $this->totalDiscount + $percentageAmount;
            return true;
        }
        
        return false;
    }
    
    /**
     * add - add values to the transaction total
     *
     * @param double $amount
     * @return boolean
     */
    public function add($amount)
    {
        if (is_double($amount)) {
            $this->totalValue = $this->totalValue + $amount;
            return true;
        }
        
        return false;
    }

    /**
     * getTotalValue - returns the total value of the transaction
     *
     * @return double
     */
    public function getTotalValue()
    {
        return ($this->totalValue-$this->totalDiscount);
    }
    
    /**
     * getTotalDiscount - returns the total discount value of the transaction
     *
     * @return double
     */
    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }
    
    /**
     * getSubTotal - returns the sub total value of the transaction
     *
     * @return double
     */
    public function getSubTotal()
    {
        return $this->totalValue;
    }
    
    /**
     * getReceipt - returns a receipt fro the transaction
     *
     * @return string
     */
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
