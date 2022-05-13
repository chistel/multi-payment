<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           PaymentWasSuccessful.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 9:05 AM
 */

namespace Chistel\MultiPayment\Events;

use Chistel\MultiPayment\Contracts\Response;

class PaymentWasSuccessful
{
    /**
     * @var Response
     */
    public $response;

    /** @var string */
    public $gateway;

    public $payer;

    /**
     * PaymentWasSuccessful constructor.
     *
     * @param $gateway
     * @param $payer
     * @param Response $response
     */
    public function __construct($gateway, $payer, Response $response)
    {
        $this->gateway = $gateway;
        $this->payer= $payer;
        $this->response = $response;
    }
}
