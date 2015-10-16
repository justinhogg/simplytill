<?php
/**
 * Description of Receipt
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Store;

class Receipt
{   
    /**
     * display - displays a receipt
     *
     * @param \Cilex\Store\Products $products - products to be displayed
     * @param double $subtotal - subtotal of the transaction
     * @param double $total - total value of the transaction
     * @param double $discount - dicount value applied to transaction
     * @return string
     */
    public static function display(\Cilex\Store\Products $products, $subtotal, $total, $discount = null)
    {   
        $text = array();
       
        $text[] = PHP_EOL.'----------Receipt '. gmdate('d-m-Y', time()) .'------------'.PHP_EOL;
        $text[] = '----------------Products----------------'.PHP_EOL;
        //products
        if(!empty($products->getProperties())) {
            foreach($products->getProperties() as $product => $value) {
                $valueFormatted = (is_double($value)) ? money_format('%.2n', $value):$value;
                //set text
                $text[] = ucwords(str_replace('-', ' ', $product)). '  ['. $valueFormatted .']';
            }
        } else {
            $text[] = 'There are no products to display!';
        }
        //subtotal
        $subtotalFormatted = (is_double($subtotal)) ? money_format('%.2n', $subtotal):$subtotal;
        $text[] = PHP_EOL.'------------------------'.PHP_EOL;
        $text[] = 'SubTotal ['. $subtotalFormatted . ']';
        
        //discount
        $discountFormatted = (is_double($discount)) ? money_format('%.2n', $discount):$discount;
        if ($discount !== null) {
            $text[] = PHP_EOL.'------------------------'.PHP_EOL;
            $text[] = 'Discount ['. $discountFormatted . ']';
        }
      
        //total
        $totalFormatted = (is_double($total)) ? money_format('%.2n', $total):$total;
        $text[] = PHP_EOL.'------------------------'.PHP_EOL;
        $text[] = 'Total ['. $totalFormatted . ']'.PHP_EOL;

        return $text;
    }
}
