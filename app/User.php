<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'marine_number', 'email', 'password',
        'rank_id',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'birth_place',
        'nationality',
        'birthday',
        'highest_career_course',
        'address',
        'gender',
        'last_promotion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rank() {
        return $this->belongsTo('App\Rank', 'rank_id');
    }
}
