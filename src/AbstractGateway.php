<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           AbstractGateway.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     13/05/2022, 9:44 AM
 */

namespace Chistel\MultiPayment;

use Chistel\MultiPayment\Contracts\Gateway;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

abstract class AbstractGateway
{
    /**
     * Length of time to store payment info in cache.
     *
     * @const integer
     */
    public const TIMEOUT = 120;

    /** @var Gateway */
    protected $gateway;

    /** @var string|int */
    protected $payer;

    public function setPayer(string|int $payer): static
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setGatewayParameters(array $parameters = []): static
    {
        $this->storeParams(array_merge($this->retrieveParams(), $parameters));

        return $this;
    }

    /**
     * Cache payment parameters for off-site payment handling.
     *
     * @param array $params
     */
    protected function storeParams(array $params): void
    {
        // Clear any previously stored parameters
        $this->clearParams();

        Cache::put($this->cacheKey(), $params, Date::now()->addMinutes(static::TIMEOUT));
    }

    /**
     * Clear cached payment parameters.
     */
    protected function clearParams(): void
    {
        Cache::forget($this->cacheKey());
    }

    protected function cacheKey(): string
    {
        return 'payment-' . $this->payer;
    }

    /**
     * Retrieve caches payment parameters for off-site payment handling.
     *
     * @param bool $returnException
     *
     * @return array|null
     */
    protected function retrieveParams(bool $returnException = true): null|array
    {
        $params = Cache::get($this->cacheKey());

        // If no params exist, the cache has timed out - took longer than 15 minutes
        if (is_null($params) && $returnException) {
            throw new \RuntimeException('Gateway parameters does not exist or has expired.');
        }

        return $params;
    }

    /**
     * Determine is test mode is on/off.
     *
     * @return bool
     */
    protected function testMode()
    {
        // TODO: add logic here
    }
}
