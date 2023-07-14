<?php

namespace App\Models;

use App\Models\SafetyObservationForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['image',
                            ];

    public function safetyobservationform()
    {
        return $this->belongsTo(SafetyObservationForm::class, 'image_id');
    }


}
