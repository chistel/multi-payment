<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           InitiatePaymentAction.php
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
use Chistel\MultiPayment\RedirectResponse;
use Chistel\MultiPayment\Response;

class InitiatePaymentAction
{
    public function __construct(
        private GatewayManager $gatewayManager
    ) {
    }

    /**
     * @param $payer
     * @param string $gatewayProvider
     * @param array  $purchaseData
     *
     * @throws InvalidGatewayDriverException
     * @throws UnSupportedGatewayException
     *
     * @return Response|RedirectResponse
     */
    public function execute($payer, string $gatewayProvider, array $purchaseData): Response|RedirectResponse
    {
        $gateway = $this->gatewayManager->create($gatewayProvider);
        $response = $gateway->setPayer($payer)
            ->purchase($purchaseData);

        if ($response->isRedirect()) {
            return $response;
        }

        if ($response->success()) {
            event(new PaymentWasSuccessful($gatewayProvider, $payer, $response));
        }

        if ($response->failed()) {
            event(new PaymentWasUnsuccessful($gatewayProvider, $payer, $response));
        }

        return $response;
    }
}
