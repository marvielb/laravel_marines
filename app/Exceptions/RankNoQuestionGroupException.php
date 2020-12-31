<?php

namespace App\Exceptions;

use Exception;

class RankNoQuestionGroupException extends Exception
{
    public function __construct()
    {
        parent::__construct("User's current rank does not belong to a question group");
    }
}
