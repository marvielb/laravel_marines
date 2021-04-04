<?php

namespace App\Http\Controllers;

use Pager;


class SMSSenderController extends Controller
{
    use Pager;

    public function tableName()
    {
        return 'applicants';
    }

    public function index()
    {
        return view('sms-sender.index');
    }
}
