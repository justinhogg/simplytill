# receipts
A simple till CLI program.

### Installation

git clone this repository.

Download composer: curl -s https://getcomposer.org/installer | php

Install dependencies, run this command from the root directory:

```php composer.phar install```

### Commands

*till*

__till:receipt__ - Produce a till receipt to calculate and display all products with a subtotal and a grand total.

To run this command from the root directory: 

```php store.php till:receipt```

### Options


### Unit Tests

To run this command from the root directory:

``` ./vendor/bin/phpunit ```