<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           GatewayManager.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     12/05/2022, 10:56 PM
 */

namespace Chistel\MultiPayment;

use Chistel\MultiPayment\Exceptions\InvalidGatewayDriverException;
use Chistel\MultiPayment\Exceptions\UnSupportedGatewayException;

class GatewayManager
{
    /**
     * Return a gateway object based on account gateway setting
     *
     * @param $paymentMethod
     * @param array $data
     * @return object
     * @throws InvalidGatewayDriverException
     * @throws UnSupportedGatewayException
     */
    public function create($paymentMethod, array $data = []): object
    {
        $config = $this->getConfig($paymentMethod);
        if (!($class = $config['driver']) || !class_exists($class)) {
            throw new InvalidGatewayDriverException($paymentMethod);
        }

        return new $class();
    }

    /**
     * @throws UnSupportedGatewayException
     */
    protected function getConfig($name)
    {
        if (!($gateway = config("multi-payment.gateways.{$name}"))) {
            throw new UnSupportedGatewayException('Payment gateway not supported');
        }
        return $gateway;
    }
}
