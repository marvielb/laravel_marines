<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Applicant extends Model
{
    use LogsActivity;

    protected $fillable = ['firstName', 'middleName', 'lastName', 'mobileNumber'];

    protected static $logAttributes = ['firstName', 'middleName', 'lastName', 'mobileNumber'];
    protected static $logOnlyDirty = true;
}
