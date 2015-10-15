<?php
/**
 * Description of Receipt
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Store;

class Receipt
{   
    public static function display(\Cilex\Store\Products $products, $subtotal, $total, $discount = 0.00)
    {   
        $text = array();
       
        $text[] = '---------------'. gmdate('d-m-Y', time()) .'---------------'.PHP_EOL;
        //products
        foreach($products->getProperties() as $product => $value) {
            //set text
            $text[] = ucwords(str_replace('-', ' ', $product)). '  ['. money_format('%.2n', $value) .']';
        }
        //subtotal
        $text[] = PHP_EOL.'----------------------------------------'.PHP_EOL;
        $text[] = 'SubTotal ['. money_format('%.2n', $subtotal) . ']';
        
        //discount
        if ($discount > 0) {
            $text[] = PHP_EOL.'----------------------------------------'.PHP_EOL;
            $text[] = 'Discount ['. money_format('%.2n', $discount) . ']';
        }
      
        //total
        $text[] = PHP_EOL.'----------------------------------------'.PHP_EOL;
        $text[] = 'Total ['. money_format('%.2n', $total) . ']';
        
        $text[] = PHP_EOL.'---------------Receipt------------------'.PHP_EOL;
        
        return $text;
    }
}
