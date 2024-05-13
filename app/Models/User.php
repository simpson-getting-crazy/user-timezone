<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Camroncade\Timezone\Facades\Timezone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set attribute to date format
     *
     * @param $input
     */
    public function setCreatedAtAttribute($input)
    {
        $this->attributes['created_at'] = Timezone::convertToUTC($input, auth()->user()->timezone ?? 'Asia/Jakarta', 'Y-m-d H:i:s');
    }

    /**
     * Get attribute from date format
     *
     * @param $input
     * @return string
     */
    public function getCreatedAtAttribute($input)
    {
        return Timezone::convertFromUTC($input, auth()->user()->timezone ?? 'Asia/Jakarta', 'Y-m-d H:i:s');
    }
}
