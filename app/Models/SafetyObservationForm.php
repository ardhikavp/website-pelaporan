<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SafetyObservationForm extends Model
{
    use HasFactory;

    protected $table = 'safety_observation_forms';
    protected $fillable = [
                            'nomor_laporan',
                            'date_finding',
                            'location_id',
                            'safety_observation_type',
                            'image_id',
                            'description',
                            'hazard_potential',
                            'impact',
                            'short_term_recommendation',
                            'middle_term_recommendation',
                            'long_term_recommendation',
                            'completation_date',
                            'created_by',
                            'reviewed_by',
                            'approved_by',
                            'review_comment',
                            'reject_comment',
                            'approve_comment',
                            'status',
                        ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
