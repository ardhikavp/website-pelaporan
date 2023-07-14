<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = ['company'];

    public function users() //hasMany
    {
        return $this->hasMany(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
