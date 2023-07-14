<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SafetyBehaviorChecklist extends Model
{
    use HasFactory;
    protected $table = 'safety_behavior_checklists';
    protected $fillable = [
                            'category',
                            'question',
];

}
