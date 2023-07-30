<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasDatabaseNotifications, RoutesNotifications;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'company_id',
        'role',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    // public function isAdmin()
    // {
    //     return $this->role === 'admin'; // Gantikan dengan logika pengecekan peran admin pada model User Anda
    // }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function safetyObservationForms()
    {
        return $this->hasMany(SafetyObservationForm::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}
