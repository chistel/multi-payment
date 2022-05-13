<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           Gateway.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 8:58 AM
 */

namespace Chistel\MultiPayment\Contracts;

use Chistel\MultiPayment\RedirectResponse;
use Chistel\MultiPayment\Response;

interface Gateway
{
    /**
     * Get test mode
     *
     * @return bool
     */
    public function getTestMode();

    /**
     * Set test mode
     *
     * @param $mode
     *
     * @return void
     */
    public function setTestMode($mode);

    /**
     * Get currency code
     *
     * @return string|null
     */
    public function getCurrency(): ?string;

    /**
     * Set the currency code
     *
     * @param string $currency
     *
     * @return void
     */
    public function setCurrency($currency);

    /**
     * Handle making the purchase
     *
     * @param array $data
     * @return Response|RedirectResponse
     */
    public function purchase(array $data = []): Response|RedirectResponse;

    /**
     * Handles completion/verification of payment
     *
     * @return mixed
     */
    public function complete(): Response;
}
