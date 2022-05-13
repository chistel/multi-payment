<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           MultiPaymentServiceProvider.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 9:05 AM
 */

namespace Chistel\MultiPayment;

use Illuminate\Support\ServiceProvider;

/**
 * Class MultiPaymentServiceProvider
 *
 * @package Chistel\MultiPayment
 */
class MultiPaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/multi-payment.php' => config_path('multi-payment.php'),
                ],
                'config'
            );
        }
    }
}