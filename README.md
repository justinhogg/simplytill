# SimplyTill
A simple till CLI program.

### Installation

git clone this repository.

Download composer: curl -s https://getcomposer.org/installer | php

Install dependencies, run this command from the root directory:

```php composer.phar install```

### Commands

*till*

__till:transaction__ - Produce a till receipt to calculate and display all products with a subtotal, discount and a grand total.

To run this command from the root directory: 

```php store.php till:transaction```

### Options


### Unit Tests

To run this command from the root directory:

``` ./vendor/bin/phpunit ```