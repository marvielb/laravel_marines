<?php

namespace App\Facades\Exam;

use Illuminate\Support\Facades\Facade;

class ExamFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'exam';
  }
}
