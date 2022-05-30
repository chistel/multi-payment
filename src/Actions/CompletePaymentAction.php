<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           CompletePaymentAction.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 9:09 AM
 */

namespace Chistel\MultiPayment\Actions;

use Chistel\MultiPayment\Events\PaymentWasSuccessful;
use Chistel\MultiPayment\Events\PaymentWasUnsuccessful;
use Chistel\MultiPayment\Exceptions\InvalidGatewayDriverException;
use Chistel\MultiPayment\Exceptions\UnSupportedGatewayException;
use Chistel\MultiPayment\GatewayManager;
use Chistel\MultiPayment\Response;

class CompletePaymentAction
{
    public function __construct(
        private GatewayManager $gatewayManager
    ) {
    }

    /**
     * @param string $gatewayProvider
     * @param $payer
     * @param array $params
     * @return Response
     * @throws InvalidGatewayDriverException
     * @throws UnSupportedGatewayException
     */
    public function execute(string $gatewayProvider, $payer, array $params = []): Response
    {
        $gateway = $this->gatewayManager->create($gatewayProvider);
        $response = $gateway->setPayer($payer)
            ->setGatewayParameters($params)
            ->complete();

        if ($response->success()) {
            event(new PaymentWasSuccessful($gatewayProvider, $payer, $response));
        } else {
            event(new PaymentWasUnsuccessful($gatewayProvider, $payer, $response));
        }

        return $response;
    }
}
