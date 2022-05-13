<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           CancelPaymentAction.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 4:20 PM
 */

namespace Chistel\MultiPayment\Actions;

use Chistel\MultiPayment\Events\PaymentWasUnsuccessful;
use Chistel\MultiPayment\Response;

class CancelPaymentAction
{
    public function execute($payer, string $gatewayProvider): void
    {
        $response = new Response(false, 'Payment cancelled', '');

        event(new PaymentWasUnsuccessful($gatewayProvider, $payer, $response));
    }
}