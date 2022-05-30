# Multi-payment for laravel
[![Latest Stable Version](http://poser.pugx.org/chistel/multi-payment/v)](https://packagist.org/packages/chistel/multi-payment) [![Total Downloads](http://poser.pugx.org/chistel/multi-payment/downloads)](https://packagist.org/packages/chistel/multi-payment) [![Latest Unstable Version](http://poser.pugx.org/chistel/multi-payment/v/unstable)](https://packagist.org/packages/chistel/multi-payment) [![License](http://poser.pugx.org/chistel/multi-payment/license)](https://packagist.org/packages/chistel/multi-payment) [![PHP Version Require](http://poser.pugx.org/chistel/multi-payment/require/php)](https://packagist.org/packages/chistel/multi-payment)


This is a very simple and light package that allows you to add multiple payment methods in your application without having to use lots of conditional statements and is library agnostic.

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

First create a gateway class of your choice with extends ``` Chistel\MultiPayment\AbstractGateway``` which should implement the purchase and complete method.
A couple of action classes for initiating and completing payments were also made available.

Based on the action classes, there are also events which can be used for listeners after success or failed payments. They return the gateway name, payer and the gateway response.

The sample below shows how the events get used via the EventProvider
```php
  PaymentWasSuccessful::class => [
            PaymentSuccessfulListener::class
        ],
        PaymentWasUnsuccessful::class => [
            PaymentUnsuccessfulListener::class
        ]
  ]

```

And your listener should be similar to the sample below

```php
class PaymentSuccessfulListener
{
    public function handle(PaymentWasSuccessful $event)
    {
        $payer = $event->user;
        $response = $event->responses
        $provider = $event->gateway;
        
        // Other code you want to added
    }
}
```


check out a full usage in the [Comprehensive demo repository](https://github.com/chistel/payment-demo) 

## Tests

The test is currently not done

## Security

If you discover any security related issues, please email me@chistel.com instead of using the issue tracker.

## Credits

- [Chistel](https://chistel.com)