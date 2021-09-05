<?php

namespace App\Exceptions;

use Exception;

class NotImplementItemsForSelectInterface extends Exception
{
    public function __toString()
    {
        return __CLASS__ . " Class doesn't implement ItemsForSelectInterface";
    }
}
