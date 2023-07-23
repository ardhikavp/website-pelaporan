<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Question;
use App\Models\CompanyOperation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $fillable = [
                        'user_id',
                        'date_finding',
                        'operation_name',
                        'company_id',
                        'answer',
                        'safety_index',
                        'nomor_laporan',
                        'reviewed_by',
                        'approved_by',
                        'review_comment',
                        'reject_comment',
                        'approve_comment',
                        'status',
                    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
