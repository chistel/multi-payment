<?php

if (!function_exists('supportedPaymentGateways')) {
    /**
     * Return all supported gateway
     *
     * @return array
     */
    function supportedPaymentGateways(): array
    {
        $gateways = [];

        foreach (config('multi-payment.gateways') as $key => $value) {
            $gateways[$key] = [
                'name' => $value['name']
            ];
        }

        return $gateways;
    }
}