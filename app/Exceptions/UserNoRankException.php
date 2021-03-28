<?php

namespace App\Exceptions;

use Exception;

class UserNoRankException extends Exception
{
    public function __construct()
    {
        parent::__construct('Marine Number does not have any rank');
    }
}
