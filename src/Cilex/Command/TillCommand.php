<?php
/**
 * Description of TillCommand
 *
 * @author Justin Hogg <justin@thekordas.com>
 */

namespace Cilex\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Cilex\Provider\Console\Command;

class TillCommand extends Command
{
    const ARGUMENT_PRODUCTS_TO_BUY  = 'productsToBuy';
    const ARGUMENT_DISCOUNT         = 'discountAmount';
    const ARGUMENT_LOCALE           = 'locale';
    
    protected $products;
    
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        //get products from flat file
        $this->products = json_decode(file_get_contents('products.json'), true);
        
        $this
            ->setName('till:transaction')
            ->setDescription('Produce a receipt for checkout out products.')
            ->addArgument(self::ARGUMENT_LOCALE, InputArgument::REQUIRED, 'Please enter the locale of this transaction!')
            ->addArgument(self::ARGUMENT_DISCOUNT, InputArgument::OPTIONAL, 'Please enter any discounts!')
            ->addArgument(self::ARGUMENT_PRODUCTS_TO_BUY, InputArgument::IS_ARRAY, 'Please enter the products to buy!');
        
    }
    
    /**
     * {@inheritDoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        //get currency type
        $input->setArgument(self::ARGUMENT_LOCALE, $this->getLocaleType($output));
        
        //get products to buy
        $input->setArgument(self::ARGUMENT_PRODUCTS_TO_BUY, $this->getProductsToBuy($input, $output));
        
        //set any discount
        $this->setDiscount($input, $output);

    }
    
    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productsToBuy  = $input->getArgument(self::ARGUMENT_PRODUCTS_TO_BUY);
        $discount       = $input->getArgument(self::ARGUMENT_DISCOUNT);
        $locale         = $input->getArgument(self::ARGUMENT_LOCALE);

        //create a new transaction
        $transaction = new \Cilex\Store\Transaction(new \Cilex\Store\Products());

        //set locale
        ($locale) ? setlocale(LC_MONETARY, $locale):false;
        
        if ($productsToBuy) {
            foreach($productsToBuy as $product) {
                //add products
                $transaction->addProduct($product, $this->products[$product]);
            }
        }
        
        //if a deposit has been made
        if ($discount && $discount > 0) {
            $transaction->addDiscount((int) $discount, (double) $transaction->getSubTotal());
        }
        
        //output
        $output->writeln($transaction->getReceipt());
    }
    
    /**
     * setDiscount - interaction to set discount amount
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return double
     */
    protected function setDiscount(InputInterface $input, OutputInterface $output)
    {
        if ($this->getHelper('dialog')->askConfirmation(
            $output,
            '<question>Would you like to enable a discount for this transaction?</question>',
            false
        )) {
            $amount = $this->getHelper('dialog')->ask(
                $output,
                'Enter the discount percentage you would like to apply: '
            );
            
            $input->setArgument(self::ARGUMENT_DISCOUNT, $amount);
            return;
        }
    }
    
    /**
     * getProductsToBuy - gets the products to buy
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return array
     */
    protected function getProductsToBuy(InputInterface $input, OutputInterface $output)
    {
        $products = $this->products;
        
        $selected = $this->getHelper('dialog')->select(
            $output,
            'Please select the products to buy. Type the name followed by a comma.',
            $products,
            ' ',
            false,
            'Value "%s" is invalid',
            true // enable multiselect
        );
 
        $selectedProducts = array_map(function ($c) use ($products) {
            return $c;
        }, $selected);
        
        return $selectedProducts;
    }
    
    /**
     * getLocaleType - interaction to establish the different currrency types
     *
     * @param OutputInterface $output
     * @return string
     */
    protected function getLocaleType(OutputInterface $output)
    {
        //set up the bank account
        $defaultType = 'en_GB';
        $question = array(
            "<comment>en_GB</comment>: British Pound\n",
            "<comment>en_US</comment>: US Dollar\n",
            "<question>Please choose a currency type:</question> [<comment>$defaultType</comment>] ",
        );

        $localeType = $this->getHelper('dialog')->askAndValidate($output, $question, function($typeInput) {
            if (!in_array($typeInput, array('en_GB','en_US'))) {
                throw new \InvalidArgumentException('Invalid type');
            }
            return $typeInput;
        }, 2, $defaultType);
        
        return $localeType;
    }

}
