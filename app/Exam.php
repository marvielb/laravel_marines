<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'user_id',
        'code'
    ];


    public static function generate($marine_number)
    {
        do {
            $code = Exam::generateCode();
            $existingCode = Exam::where('code', $code)->get();
        } while ($existingCode->isEmpty() == false);
        $user = User::where('marine_number', $marine_number)->first();
        $examCode = Exam::create([
            'user_id' => $user['id'],
            'code' => $code
        ]);

        return $examCode;
    }

    public static function generateCode()
    {
        return strtoupper(sha1(time()));
    }
}
