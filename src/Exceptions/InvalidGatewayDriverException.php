<?php
/*
 * Copyright (C) 2022,  Chistel Brown,  - All Rights Reserved
 * @project                  multi-payment
 * @file                           InvalidGatewayException.php
 * @author                  Chistel Brown
 * @site                          <http://twitter.com/chistelbrown>
 * @email                      chistelbrown@gmail.com
 * @lastmodified     12/05/2022, 10:56 PM
 */

namespace Chistel\MultiPayment\Exceptions;

class InvalidGatewayDriverException extends \Exception
{
    public function __construct($name)
    {
        $this->message = "{$name} driver not defined or driver class does not exist.";
    }
}
