<?php

namespace App\Models;


use App\Models\SafetyObservationForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = ['location'];

    // public function safetyobservationforms()
    // {
    //     return $this->hasMany(SafetyObservationForm::class);
    // }

}
