# Multi-payment for laravel

This is a very simple and light package that allows you to add multiple payment methods in your application without having to use lots of conditional statements.

With this package, you can keep the uniformity of initiating and verifying payments.

## Installation

This package can be installed through Composer.

```
composer require chistel/multi-payment
```

In Laravel 5.5 and above the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers'=> [
    ...
    Chistel\MultiPayment\MultiPaymentServiceProvider::class,
];
```

Optionally you can publish the config file with:

```bash
php artisan vendor:publish --provider="Chistel\MultiPayment\MultiPaymentServiceProvider" --tag="config"
```

This is the content of the file that will be published in `config/multi-payment.php`

```php
return [
  /*
   * An array of supported gateways
   */
  'gateways' => [
        'paystack' => [
            'name' => 'Paystack',
            'driver' => PaystackGateway::class
        ]
  ]
];
```

## Usage

check out it usage in the sample repository

## Tests

The test is currently not done

## Security

If you discover any security related issues, please email me@chistel.com instead of using the issue tracker.

## Credits

- [Chistel](https://chistel.com)