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
                        'operation_name',
                        'company_id',
                        'answer',
                        'safety_index',
                        'nomor_laporan',
                    ];

    // public function question()
    // {
    //     return $this->belongsTo(Question::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
