<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           RedirectResponse.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 8:22 AM
 */

namespace Chistel\MultiPayment;

use Chistel\MultiPayment\Contracts\Response as ResponseInterface;

class RedirectResponse implements ResponseInterface
{
    /**
     * @var array
     */
    protected array $data = [];

    public function __construct(
        protected $redirectUrl
    ) {
    }

    public function transactionRef(): ?string
    {
        return null;
    }

    public function success(): bool
    {
        return true;
    }

    public function failed(): bool
    {
        return false;
    }

    public function message(): string
    {
        return "Redirecting to: {$this->redirectUrl}";
    }

    public function amount(): float
    {
        return 0.00;
    }

    public function currency(): string
    {
        return '';
    }

    public function isRedirect(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function redirectUrl(): string
    {
        return $this->redirectUrl;
    }

    /**
     * @param array $data
     *
     * @return RedirectResponse
     */
    public function setData(array $data = []): static
    {
        $this->data = $data;

        return $this;
    }

    public function data()
    {
        return $this->data;
    }
}
