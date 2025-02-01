<?php

namespace App\Exceptions;

use Exception;

class ProductStockException extends Exception
{
    protected $message = 'Not enough stock.';
    protected $code = 406;
}
