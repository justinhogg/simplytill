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
    const ARGUMENT_PRODUCTS         = 'products';
    const ARGUMENT_PRODUCTS_TO_BUY  = 'productsToBuy';
    const ARGUMENT_DISCOUNT         = 'discountAmount';
    
    protected $products;
    
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        //get products from flat file
        $this->products = json_decode(file_get_contents('products.json'), true);
        
        $this
            ->setName('till:receipt')
            ->setDescription('Produce a receipt for checkout out products.')
            ->addArgument(self::ARGUMENT_DISCOUNT, InputArgument::OPTIONAL, 'Please enter any discounts!')
            ->addArgument(self::ARGUMENT_PRODUCTS_TO_BUY, InputArgument::IS_ARRAY, 'Please enter the products to buy!');
        
    }
    
    /**
     * {@inheritDoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        //set product prices
        $input->setArgument(self::ARGUMENT_PRODUCTS, $this->getProducts($input, $output));

    }
    
    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = array();
        
        
        //output
        $output->writeln($text);
    }
    
    protected function getProducts(InputInterface $input, OutputInterface $output)
    {
        $products = $this->products;
        
        $selected = $this->getHelper('dialog')->select(
            $output,
            'Please select the products to buy',
            $products,
            2,
            false,
            'Value "%s" is invalid',
            true // enable multiselect
        );

        $selectedProducts = array_map(function ($c) use ($products) {
            return $products[$c];
        }, $selected);
    }

}
