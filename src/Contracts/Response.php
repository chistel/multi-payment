<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           Response.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 8:19 AM
 */

namespace Chistel\MultiPayment\Contracts;

interface Response
{
    /**
     * Return the transaction reference returned by the payment provider
     *
     * @return string|null
     */
    public function transactionRef(): ?string;

    /**
     * Determine if the payment was successful
     *
     * @return bool
     */
    public function success(): bool;

    /**
     * Determine if the payment failed
     *
     * @return bool
     */
    public function failed(): bool;

    /**
     * Return the message success/error returned by the payment provider
     *
     * @return string
     */
    public function message(): string;

    /**
     * Returns the gateway charged amount - formatted
     *
     * @return float
     */
    public function amount(): float;

    /**
     * Return the currency used
     *
     * @return string
     */
    public function currency(): string;

    /**
     * Is it a redirect?
     *
     * @return bool
     */
    public function isRedirect(): bool;
}
