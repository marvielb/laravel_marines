<?php

namespace App\Exceptions;

use Exception;

class ExamFinishedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Exam Already Finished');
    }
}
