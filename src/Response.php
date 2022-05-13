<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           Response.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     12/05/2022, 10:56 PM
 */

namespace Chistel\MultiPayment;

use Chistel\MultiPayment\Contracts\Response as ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @param bool        $success
     * @param string|null $message
     * @param string|null $transactionRef
     * @param float       $amount
     * @param string      $currency
     */
    public function __construct(
        protected bool $success,
        protected ?string $message = '',
        protected ?string $transactionRef = '',
        protected float $amount = 0.00,
        protected string $currency = ''
    ) {
    }

    /**
     * Return the transaction reference returned by the payment provider.
     *
     * @return string|null
     */
    public function transactionRef(): ?string
    {
        return $this->transactionRef;
    }

    /**
     * Determine if the payment was successful.
     *
     * @return bool
     */
    public function success(): bool
    {
        return $this->success === true;
    }

    /**
     * Determine if the payment failed.
     *
     * @return bool
     */
    public function failed(): bool
    {
        return $this->success === false;
    }

    /**
     * Return the message success/error returned by the payment provider.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * Return the amount charged.
     *
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }

    /**
     * Return the currency used.
     *
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * Is it a redirect?
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return false;
    }
}
